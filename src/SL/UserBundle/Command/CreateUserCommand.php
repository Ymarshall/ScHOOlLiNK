<?php

namespace SL\UserBundle\Command;
 
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FOS\UserBundle\Command\CreateUserCommand as BaseCommand;
 
class CreateUserCommand extends BaseCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('sl:user:create')
            ->getDefinition()->addArguments(array(
                new InputArgument('nom', InputArgument::REQUIRED, 'The firstname'),
                new InputArgument('prenoms', InputArgument::REQUIRED, 'The lastname'),
                 new InputArgument('dateNaissance', InputArgument::REQUIRED, 'The birthday'),
                new InputArgument('sexe', InputArgument::REQUIRED, 'The gender'),
                 new InputArgument('adresse', InputArgument::REQUIRED, 'The address'),
                new InputArgument('telephone', InputArgument::REQUIRED, 'The Phone number'),
                new InputArgument('image', InputArgument::REQUIRED, 'The Picture')
            ))
        ;
        $this->setHelp(<<<EOT
// L'aide qui va bien
EOT
            );
    }
 
    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username   = $input->getArgument('username');
        $email      = $input->getArgument('email');
        $password   = $input->getArgument('password');
        $firstname  = $input->getArgument('nom');
        $lastname   = $input->getArgument('prenoms');
        $birthday  = $input->getArgument('dateNaissance');
        $gender   = $input->getArgument('sexe');
        $telephone  = $input->getArgument('telephone');
        $address   = $input->getArgument('adresse');
        $image   = $input->getArgument('image');
        $inactive   = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');
 
        /** @var \FOS\UserBundle\Model\UserManager $user_manager */
        $user_manager = $this->getContainer()->get('fos_user.user_manager');
 
        /** @var \SL\UserBundle\Entity\User $user */
        $user = $user_manager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled((Boolean) !$inactive);
        $user->setSuperAdmin((Boolean) $superadmin);
        $user->setNom($firstname);
        $user->setPrenoms($lastname);
        $user->setSexe($gender);
        $user->setDateNaissance($birthday);
        $user->setAdresse($address);
        $user->setTelephone($telephone);
        $user->setImage($image);
 
        $user_manager->updateUser($user);
 
        $output->writeln(sprintf('Created user <comment>%s</comment>', $username));
    }
    
    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        if (!$input->getArgument('nom')) {
            $firstname = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a firstname:',
                function($firstname) {
                    if (empty($firstname)) {
                        throw new \Exception('Firstname can not be empty');
                    }
 
                    return $firstname;
                }
            );
            $input->setArgument('nom', $firstname);
        }
        if (!$input->getArgument('prenoms')) {
            $lastname = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a lastname:',
                function($lastname) {
                    if (empty($lastname)) {
                        throw new \Exception('Lastname can not be empty');
                    }
 
                    return $lastname;
                }
            );
            $input->setArgument('prenoms', $lastname);
        }
        if (!$input->getArgument('dateNaissance')) {
            $birthday = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a birthday:',
                function($birthday) {
                    if (empty($birthday)) {
                        throw new \Exception('birthday can not be empty');
                    }
 
                    return $birthday;
                }
            );
            $input->setArgument('dateNaissance', $birthday);
        }
        if (!$input->getArgument('sexe')) {
            $gender = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a gender (M=1) (F=2) :',
                function($gender) {
                    if (empty($gender)) {
                        throw new \Exception('gender can not be empty');
                    }
 
                    return $gender;
                }
            );
            $input->setArgument('sexe', $gender);
        }
        if (!$input->getArgument('adresse')) {
            $address = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose an address :',
                function($address) {
                    if (empty($address)) {
                        throw new \Exception('address can not be empty');
                    }
 
                    return $address;
                }
            );
            $input->setArgument('adresse', $address);
        }
        if (!$input->getArgument('telephone')) {
            $telephone = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a telephone number :',
                function($telephone) {
                    return $telephone;
                }
            );
            $input->setArgument('telephone', $telephone);
        }
        
        if (!$input->getArgument('image')) {
            $image = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a picture :',
                function($image) {
                    return $image;
                }
            );
            $input->setArgument('image', $image);
        }
    }
}
