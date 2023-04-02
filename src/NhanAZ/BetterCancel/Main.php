<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\EventPriority;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

	protected function onEnable(): void {
		$manger = $this->getServer()->getPluginManager();
		$handler = static function(BlockBreakEvent|BlockPlaceEvent $event) : void{
			$event->cancel();
			if(!$event->isCancelled()) return;
			$player = $event->getPlayer();
			$session = $player->getNetworkSession();
			$session->sendDataPacket(DenySound::getPacket($player->getLocation()));
			$session->sendDataPacket(ForceFieldParticle::getPacket(
				$event->getBlock()->getPosition()
			));
		};
		$manger->registerEvent(
			event: BlockBreakEvent::class,
			handler: $handler,
			priority: EventPriority::MONITOR,
			plugin: $this,
			handleCancelled: true
		);
		$manger->registerEvent(
			event: BlockPlaceEvent::class,
			handler: $handler,
			priority: EventPriority::MONITOR,
			plugin: $this,
			handleCancelled: true
		);
	}
}
