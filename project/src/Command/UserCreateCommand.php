<?php

namespace App\Command;

use Exception;
use App\Entity\User;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'app:user:create';

    protected $em;

    protected $encoder;

    public function __construct(RegistryInterface $registry, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct();
        $this->em = $registry->getManager();
        $this->encoder = $encoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create new user.')
            ->addArgument('username', InputArgument::OPTIONAL, 'Username')
            ->addArgument('password', InputArgument::OPTIONAL, 'User Password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        try {
            if (!$username = $input->getArgument('username')) if (!$username = $io->ask('Username')) throw new Exception('Username cannot be blank.');
            if (!$password = $input->getArgument('password')) if (!$password = $io->ask('Password')) throw new Exception('Password cannot be blank.');
            $user = new User();
            $user->setUsername($username);
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $user->setRoles(array('ROLE_USER'));
            $this->em->persist($user);
            $this->em->flush();
            $io->success('Created user.');
        } catch (Exception $e) {
            if ($e->getPrevious()) $message = $e->getPrevious()->getMessage(); else $message = $e->getMessage();
            $io->error($message);
        }
    }
}
