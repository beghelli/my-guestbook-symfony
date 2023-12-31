<?php

namespace App\EventSubscriber;

use App\Repository\ConferenceRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class ComposeTemplateSubscriber implements EventSubscriberInterface
{

	private $conferenceRepository;
	private $twig;

	public function __construct(Environment $twig, ConferenceRepository $conferenceRepository)
	{
		$this->conferenceRepository = $conferenceRepository;
		$this->twig = $twig;
	}

    public function onControllerEvent(ControllerEvent $event): void
    {
		$this->twig->addGlobal('conferences', $this->conferenceRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'Symfony\Component\HttpKernel\Event\ControllerEvent' => 'onControllerEvent',
        ];
    }
}
