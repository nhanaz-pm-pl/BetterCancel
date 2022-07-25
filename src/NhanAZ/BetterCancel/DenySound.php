<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\world\sound\Sound;

class DenySound implements Sound {

	public function encode(Vector3 $vector3): array {
		return [LevelSoundEventPacket::nonActorSound(LevelSoundEvent::DENY, $vector3, false)];
	}
}
