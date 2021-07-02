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
          
        }
    }
}
