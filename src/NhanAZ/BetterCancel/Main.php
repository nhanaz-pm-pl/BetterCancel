<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	private function onCancel(BlockBreakEvent|BlockPlaceEvent $event): void {
		$player = $event->getPlayer();
		$vector3 = $event->getBlock()->getPosition();
		if ($event->isCancelled()) {
			$player->broadcastSound(new DenySound(), [$player]);
			ForceFieldParticle::addParticle($vector3, $player);
		}
	}

	/**
	 * @handleCancelled
	 */
	public function onBlockBreak(BlockBreakEvent $event): void {
		$this->onCancel($event);
	}

	/**
	 * @handleCancelled
	 */
	public function onBlockPlace(BlockPlaceEvent $event): void {
		$this->onCancel($event);
	}
}
