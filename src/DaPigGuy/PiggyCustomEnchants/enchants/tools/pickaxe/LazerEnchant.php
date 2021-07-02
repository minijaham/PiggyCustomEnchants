<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\tools\pickaxe;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\block\Block;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class LazerEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Lazer";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_SIMPLE;

    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_PICKAXE;

    public function getReagent(): array
    {
        return [PlayerInteractEvent::class];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof PlayerInteractEvent) {
          $nbt = new CompoundTag('', [
		    'Pos' => new ListTag('Pos', [
			    new DoubleTag('', $player->getX()),
		    	new DoubleTag('', $player->getY() + $player->getEyeHeight()),
		    	new DoubleTag('', $player->getZ())
		    ]),
		    'Motion' => new ListTag('Motion', [
		    	new DoubleTag("", -sin($player->yaw / 180 * M_PI) * cos($player->pitch / 180 * M_PI)),
		    	new DoubleTag("", -sin($player->pitch / 180 * M_PI)),
			    new DoubleTag("", cos($player->yaw / 180 * M_PI) * cos($player->pitch / 180 * M_PI))
	    	]),
		    'Rotation' => new ListTag('Rotation', [
		    	new FloatTag('', lcg_value() * 360),
		    	new FloatTag('', 0)
	    	]),
	    ]);
	    $entity = Entity::createEntity("PiggySnowball", $player->getLevel(), $nbt);
	    $entity->setOwningEntity($player);
	    $entity->setMotion($entity->getMotion()->multiply(2));
	    $entity->setCanSaveWithChunk(false);
	    $entity->spawnToAll();
        }
    }
}
