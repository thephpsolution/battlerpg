<?php

namespace AppBundle\Command;

use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DataSetupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('data:setup')
            ->setDescription('Sets up the initial data.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = (new User())
            ->setEmail('jonathan@thephpsolution.com')
            ->setUsername('michael')
            ->setPlainPassword('rpg')
            ->setEnabled(true)
            ->setSuperAdmin(true)
            ->addRole('ADMIN')
        ;

        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $em->persist($user);
        $em->flush();

        $output->writeln('Command result.');
    }

}
