<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	private function playSound(Player $player): void {
		$player->broadcastSound(new DenySound(), [$player]);
	}

	private function addParticle(Vector3 $vector3, Player $player): void {
		ForceFieldParticle::addParticle($vector3, $player);
	}

	private function betterCancel(BlockBreakEvent|BlockPlaceEvent $event): void {
		$block = $event->getBlock();
		$player = $event->getPlayer();
		if ($event->isCancelled()) {
			$this->playSound($player);
			$this->addParticle($block->getPosition(), $player);
		}
	}

	/**
	 * @handleCancelled
	 */
	public function onBlockBreak(BlockBreakEvent $event) {
		$this->betterCancel($event);
	}

	/**
	 * @handleCancelled
	 */
	public function onBlockPlace(BlockPlaceEvent $event) {
		$this->betterCancel($event);
	}
}
