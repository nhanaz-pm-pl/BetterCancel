<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\EventPriority;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getPluginManager()->registerEvent(
			event: BlockBreakEvent::class,
			handler: function (BlockBreakEvent $event): void {
				$this->onCancel($event);
			},
			priority: EventPriority::MONITOR,
			plugin: $this,
			handleCancelled: true
		);
		$this->getServer()->getPluginManager()->registerEvent(
			event: BlockPlaceEvent::class,
			handler: function (BlockPlaceEvent $event): void {
				$this->onCancel($event);
			},
			priority: EventPriority::MONITOR,
			plugin: $this,
			handleCancelled: true
		);
	}

	private function onCancel(BlockBreakEvent|BlockPlaceEvent $event): void {
		$player = $event->getPlayer();
		$vector3 = $event->getBlock()->getPosition();
		if ($event->isCancelled()) {
			$player->broadcastSound(new DenySound(), [$player]);
			ForceFieldParticle::addParticle($vector3, $player);
		}
	}
}
