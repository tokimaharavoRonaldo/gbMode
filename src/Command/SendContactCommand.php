<?php

namespace App\Command;

use App\Repository\ContactRepository;
use App\Repository\AproposRepository;
use App\Service\ContactService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendContactCommand extends Command
{
    private $contactRepository;
    private $mailer;
    private $contactService ;
    private $aproposRepository;
    protected static $defaultName = 'app:send-contact';

    public function __construct(
        ContactRepository $contactRepository,
        MailerInterface $mailer,
        ContactService $contactService,
        AproposRepository $aproposRepository
    ){
     $this ->contactRepository = $contactRepository;  
     $this ->mailer = $mailer;  
     $this ->contactService = $contactService;  
     $this ->aproposRepository = $aproposRepository;  
     $this ->contactRepository = $contactRepository;
     parent::__construct();  
    }

    protected function execute(InputInterface $input,OutputInterface $output){
        $toSend=$this->contactRepository->findBy(['isSend'=>false]);
        $adress=new Address($this->aproposRepository->apropos()->getEmail(),$this->aproposRepository->apropos()->getTitre());

        foreach($toSend as $mail){
            $email=(new Email() ) 
            ->from($mail->getEmail())
            ->to($adress)
            ->subject('nouveau message de'.$mail->getNom())
            ->text($mail->getMessage());

            $this->mailer->send($email);
            $this->contactService->isSend($mail);
        }
        return Command::SUCCESS;
    }
}