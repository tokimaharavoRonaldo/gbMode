<?php

namespace App\Command;

use App\Entity\Apropos;
use App\Repository\ContactRepository;
use App\Repository\AproposRepository;
use App\Service\ContactService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class CreateCompteCommand extends Command
{
    private $entityManagerInterface;
    private $encoder;
 
    protected static $defaultName = 'app:create-compte';

    public function __construct(
        EntityManagerInterface $entityManagerInterface
    ){
     $this ->entityManagerInterface = $entityManagerInterface;
     parent::__construct();  
    }

    protected function configure(): void
    {
        $this->addArgument('titre', InputArgument::REQUIRED, 'The name of entreprise')
        ->addArgument('contact', InputArgument::REQUIRED, 'The mobile of entreprise');
    }
   
    protected function execute(InputInterface $input, OutputInterface $output)
{
    $apropos=new Apropos();
    $apropos->setTitre($input->getArgument('titre'));
    $apropos->setContact($input->getArgument('contact'));
    $apropos->setEmail('');
    $apropos->setDescription('');
    $apropos->setFile('');
    $apropos->setLogo('');
    $apropos->setFacebook('');

    dump($apropos);
    $this->entityManagerInterface->persist($apropos);
    $this->entityManagerInterface->flush();
    return Command::SUCCESS;
}}