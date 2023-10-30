<?php

namespace libproxy;

use Exception;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\EntityEventBroadcaster;
use pocketmine\network\mcpe\PacketBroadcaster;
use pocketmine\network\mcpe\protocol\serializer\PacketSerializerContext;
use pocketmine\network\mcpe\raklib\RakLibInterface;
use pocketmine\Server;
use ReflectionClass;
use function method_exists;

class PMUtils
{
    public static function getPacketSerializerContext(RakLibInterface $interface): PacketSerializerContext
    {

        $packetSerializerContext = self::getRaklibInterfacePropertyValue($interface, 'packetSerializerContext');
        if ($packetSerializerContext instanceof PacketSerializerContext) {
            return $packetSerializerContext;
        }

        throw new Exception("PacketSerializerContext isn't valid");
    }

    public static function getPacketBroadcaster(RakLibInterface $interface): PacketBroadcaster
    {

        $packetBroadcaster = self::getRaklibInterfacePropertyValue($interface, 'packetBroadcaster');
        if ($packetBroadcaster instanceof PacketBroadcaster) {
            return $packetBroadcaster;
        }

        throw new Exception("PacketBroadcaster isn't valid");
    }

    public static function getEntityEventBroadcaster(RakLibInterface $interface): EntityEventBroadcaster
    {

        $entityEventBroadcaster = self::getRaklibInterfacePropertyValue($interface, 'entityEventBroadcaster');
        if ($entityEventBroadcaster instanceof EntityEventBroadcaster) {
            return $entityEventBroadcaster;
        }

        throw new Exception("EntityEventBroadcaster isn't valid");
    }

    private static function getRaklibInterfacePropertyValue(RakLibInterface $interface, string $propertyName): mixed
    {
        $reflection = new ReflectionClass($interface);
        $property = $reflection->getProperty($propertyName);

        return $property->getValue($interface);
    }
}