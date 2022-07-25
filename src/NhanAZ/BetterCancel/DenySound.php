<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\math\Vector3;
use pocketmine\world\sound\Sound;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;

class DenySound implements Sound {

	public function encode(Vector3 $pos): array {
		return [LevelSoundEventPacket::nonActorSound(LevelSoundEvent::DENY, $pos, false)];
	}
}
