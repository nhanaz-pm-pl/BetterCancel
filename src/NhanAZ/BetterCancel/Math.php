<?php

declare(strict_types=1);

namespace NhanAZ\BetterCancel;

use pocketmine\math\Vector3;

class Math {

	public static function Center(Vector3 $vector3): Vector3 {
		return $vector3->add(0.5, 0.5, 0.5);
	}
}
