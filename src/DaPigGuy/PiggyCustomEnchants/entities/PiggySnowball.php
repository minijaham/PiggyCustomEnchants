<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\entities;

use DaPigGuy\PiggyCustomEnchants\utils\AllyChecks;
use pocketmine\block\Block;
use pocketmine\entity\Entity
use pocketmine\math\RayTraceResult;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\math\Vector3;

class PiggySnowball extends PiggyProjectile
{
    const NETWORK_ID = Entity::SNOWBALL;

    /** @var float */
    public $width = 0.2;
    /** @var float */
    public $length = 0.2;
    /** @var float */
    public $height = 0.2;

    /** @var float */
    protected $drag = 0.01;
    /** @var float */
    protected $gravity = 0.05;

    public function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void
    {
        $owner = $this->getOwningEntity();
        $entityHit->getLevel()->addParticle(new DestroyBlockParticle($entityHit->add(0.5, 0.5, 0.5), Block::get(Block::REDSTONE_BLOCK)));
		
		    $sound = new PlaySoundPacket();
		    $sound->soundName = "random.explode";
		    $sound->x = $entityHit->getX();
		    $sound->y = $entityHit->getY();
		    $sound->z = $entityHit->getZ();
		    $sound->volume = 2;
		    $sound->pitch = 1;
		    Server::getInstance()->broadcastPacket($entityHit->getLevel()->getPlayers(), $sound);
        parent::onHitEntity($entityHit, $hitResult);
    }
}
