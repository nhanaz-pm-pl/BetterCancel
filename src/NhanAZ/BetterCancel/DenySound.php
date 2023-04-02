<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\world\sound\Sound;

final class DenySound implements Sound {

	public static function getPacket(Vector3 $vector3) : LevelSoundEventPacket{
		return LevelSoundEventPacket::nonActorSound(LevelSoundEvent::DENY, $vector3, false);
	}

	public function encode(Vector3 $pos): array {
		return [self::getPacket($pos)];
	}
}
