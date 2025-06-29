<?php

declare(strict_types=1);

namespace App\UserDomain\Presentation\Command;

use App\SharedDomain\Application\Cqrs\CommandBusInterface;
use App\UserDomain\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(name: 'app:create-admin', description: 'Create a new admin user')]
class CreateAdminCommand extends Command
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email администратора')
            ->addArgument('password', InputArgument::OPTIONAL, 'Пароль администратора');
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (!$input->getArgument('password')) {
            $question = new Question('Put password: ');
            $question->setHidden(true);
            $question->setHiddenFallback(false);
            /** @var QuestionHelper $helper */
            $helper = $this->getHelper('question');
            $password = $helper->ask($input, $output, $question);
            $input->setArgument('password', $password);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->commandBus->dispatch(new CreateUserCommand(
            email: $input->getArgument('email'),
            password: $input->getArgument('password'),
            roles: ['ROLE_ADMIN']
        ));

        $output->writeln(sprintf(
            '<info>Admin "%s" was successfully created</info>', $input->getArgument('email')
        ));

        return Command::SUCCESS;
    }
}
