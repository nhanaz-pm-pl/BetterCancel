<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\world\sound\Sound;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\world\particle\BlockForceFieldParticle;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	private function playSound(Player $player): void {
		$player->broadcastSound(new DenySound(), [$player]);
	}

	private function addParticle(Vector3 $position): void {
		$pos = $position->add(0.5, 0.5, 0.5);
		$particle = new BlockForceFieldParticle(2008);
		$position->getWorld()->addParticle($pos, $particle);
	}

	private function betterCancel(BlockBreakEvent|BlockPlaceEvent $event): void {
		$block = $event->getBlock();
		$player = $event->getPlayer();
		if ($event->isCancelled()) {
			$this->playSound($player);
			$this->addParticle($block->getPosition());
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

class DenySound implements Sound {

	public function encode(Vector3 $pos): array {
		return [LevelSoundEventPacket::nonActorSound(LevelSoundEvent::DENY, $pos, false)];
	}
}
