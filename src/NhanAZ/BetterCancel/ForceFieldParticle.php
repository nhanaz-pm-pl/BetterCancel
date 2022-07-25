<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelEvent;
use pocketmine\player\Player;

class ForceFieldParticle {

	public static function addParticle(Vector3 $vector3, Player $player): void {
		$packet = new LevelEventPacket();
		$packet->eventId = LevelEvent::PARTICLE_BLOCK_FORCE_FIELD;
		$packet->eventData = $eventData = (int) 0;
		$packet->position = Math::Center($vector3);
		$player->getNetworkSession()->sendDataPacket($packet);
	}
}
