<?php

namespace kevinfrom\GA4MP\Events;

use InvalidArgumentException;
use kevinfrom\GA4MP\Utility\Formattable;

class EventItem
{
    use Formattable;

    /**
     * @var string|null $item_id
     */
    private ?string $item_id = null;

    /**
     * @var string|null $item_name
     */
    private ?string $item_name = null;

    /**
     * @var string|null $affiliation
     */
    private ?string $affiliation = null;

    /**
     * @var string|null $coupon
     */
    private ?string $coupon = null;

    /**
     * @var float|null $discount
     */
    private ?float $discount = null;

    /**
     * @var int|null $index
     */
    private ?int $index = null;

    /**
     * @var string|null $item_brand
     */
    private ?string $item_brand = null;

    /**
     * @var string|null $item_category
     */
    private ?string $item_category = null;

    /**
     * @var string|null $item_category2
     */
    private ?string $item_category2 = null;

    /**
     * @var string|null $item_category3
     */
    private ?string $item_category3 = null;

    /**
     * @var string|null $item_category4
     */
    private ?string $item_category4 = null;

    /**
     * @var string|null $item_category5
     */
    private ?string $item_category5 = null;

    /**
     * @var string|null $item_list_id
     */
    private ?string $item_list_id = null;

    /**
     * @var string|null $item_list_name
     */
    private ?string $item_list_name = null;

    /**
     * @var string|null $item_variant
     */
    private ?string $item_variant = null;

    /**
     * @var string|null $location_id
     */
    private ?string $location_id = null;

    /**
     * @var float|null $price
     */
    private ?float $price = null;

    /**
     * @var int|null $quantity
     */
    private ?int $quantity = null;

    /**
     * @param string|null $itemId
     * @param string|null $itemName
     */
    public function __construct(?string $itemId = null, ?string $itemName = null)
    {
        if (!$itemId && !$itemName) {
            throw new InvalidArgumentException('Either item_id or item_name must be set');
        }

        $this->setItemId($itemId);
        $this->setItemName($itemName);
    }

    /**
     * Set item id
     *
     * @param ?string $itemId
     *
     * @return self
     */
    public function setItemId(?string $itemId): self
    {
        $this->item_id = $itemId;

        return $this;
    }

    /**
     * Get item id
     *
     * @return ?string
     */
    public function getItemId(): ?string
    {
        return $this->item_id;
    }

    /**
     * Set item name
     *
     * @param ?string $itemName
     *
     * @return self
     */
    public function setItemName(?string $itemName): self
    {
        $this->item_name = $itemName;

        return $this;
    }

    /**
     * Get item name
     *
     * @return ?string
     */
    public function getItemName(): ?string
    {
        return $this->item_name;
    }

    /**
     * Set affiliation
     *
     * @param ?string $affiliation
     *
     * @return self
     */
    public function setAffiliation(?string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    /**
     * Get affiliation
     *
     * @return ?string
     */
    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    /**
     * Set coupon
     *
     * @param ?string $coupon
     *
     * @return self
     */
    public function setCoupon(?string $coupon): self
    {
        $this->coupon = $coupon;

        return $this;
    }

    /**
     * Get coupon
     *
     * @return ?string
     */
    public function getCoupon(): ?string
    {
        return $this->coupon;
    }

    /**
     * Set discount
     *
     * @param ?float $discount
     *
     * @return self
     */
    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return ?float
     */
    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    /**
     * Set index
     *
     * @param ?int $index
     *
     * @return self
     */
    public function setIndex(?int $index): self
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Get index
     *
     * @return ?int
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * Set item brand
     *
     * @param ?string $itemBrand
     *
     * @return self
     */
    public function setItemBrand(?string $itemBrand): self
    {
        $this->item_brand = $itemBrand;

        return $this;
    }

    /**
     * Get item brand
     *
     * @return ?string
     */
    public function getItemBrand(): ?string
    {
        return $this->item_brand;
    }

    /**
     * Set item category
     *
     * @param ?string $itemCategory
     *
     * @return self
     */
    public function setItemCategory(?string $itemCategory): self
    {
        $this->item_category = $itemCategory;

        return $this;
    }

    /**
     * Get item category
     *
     * @return ?string
     */
    public function getItemCategory(): ?string
    {
        return $this->item_category;
    }

    /**
     * Set item category 2
     *
     * @param ?string $itemCategory2
     *
     * @return self
     */
    public function setItemCategory2(?string $itemCategory2): self
    {
        $this->item_category2 = $itemCategory2;

        return $this;
    }

    /**
     * Get item category 2
     *
     * @return ?string
     */
    public function getItemCategory2(): ?string
    {
        return $this->item_category2;
    }

    /**
     * Set item category 3
     *
     * @param ?string $itemCategory3
     *
     * @return self
     */
    public function setItemCategory3(?string $itemCategory3): self
    {
        $this->item_category3 = $itemCategory3;

        return $this;
    }

    /**
     * Get item category 3
     *
     * @return ?string
     */
    public function getItemCategory3(): ?string
    {
        return $this->item_category3;
    }

    /**
     * Set item category 4
     *
     * @param ?string $itemCategory4
     *
     * @return self
     */
    public function setItemCategory4(?string $itemCategory4): self
    {
        $this->item_category4 = $itemCategory4;

        return $this;
    }

    /**
     * Get item category 4
     *
     * @return ?string
     */
    public function getItemCategory4(): ?string
    {
        return $this->item_category4;
    }

    /**
     * Set item category 5
     *
     * @param ?string $itemCategory5
     *
     * @return self
     */
    public function setItemCategory5(?string $itemCategory5): self
    {
        $this->item_category5 = $itemCategory5;

        return $this;
    }

    /**
     * Get item category 5
     *
     * @return ?string
     */
    public function getItemCategory5(): ?string
    {
        return $this->item_category5;
    }

    /**
     * Set item list id
     *
     * @param ?string $itemListId
     *
     * @return self
     */
    public function setItemListId(?string $itemListId): self
    {
        $this->item_list_id = $itemListId;

        return $this;
    }

    /**
     * Get item list id
     *
     * @return ?string
     */
    public function getItemListId(): ?string
    {
        return $this->item_list_id;
    }

    /**
     * Set item list name
     *
     * @param ?string $itemListName
     *
     * @return self
     */
    public function setItemListName(?string $itemListName): self
    {
        $this->item_list_name = $itemListName;

        return $this;
    }

    /**
     * Get item list name
     *
     * @return ?string
     */
    public function getItemListName(): ?string
    {
        return $this->item_list_name;
    }

    /**
     * Set item variant
     *
     * @param ?string $itemVariant
     *
     * @return self
     */
    public function setItemVariant(?string $itemVariant): self
    {
        $this->item_variant = $itemVariant;

        return $this;
    }

    /**
     * Get item variant
     *
     * @return ?string
     */
    public function getItemVariant(): ?string
    {
        return $this->item_variant;
    }

    /**
     * Set location id
     *
     * @param ?string $locationId
     *
     * @return self
     */
    public function setLocationId(?string $locationId): self
    {
        $this->location_id = $locationId;

        return $this;
    }

    /**
     * Get location id
     *
     * @return ?string
     */
    public function getLocationId(): ?string
    {
        return $this->location_id;
    }

    /**
     * Set price
     *
     * @param ?float $price
     *
     * @return self
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return ?float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param ?int $quantity
     *
     * @return self
     */
    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return ?int
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @inheritDoc
     */
    public function formatData(): array
    {
        return array_filter([
            'item_id'        => $this->getItemId(),
            'item_name'      => $this->getItemName(),
            'affiliation'    => $this->getAffiliation(),
            'coupon'         => $this->getCoupon(),
            'discount'       => $this->getDiscount() ? round($this->getDiscount(), 2) : null,
            'index'          => $this->getIndex(),
            'item_brand'     => $this->getItemBrand(),
            'item_category'  => $this->getItemCategory(),
            'item_category2' => $this->getItemCategory2(),
            'item_category3' => $this->getItemCategory3(),
            'item_category4' => $this->getItemCategory4(),
            'item_category5' => $this->getItemCategory5(),
            'item_list_id'   => $this->getItemListId(),
            'item_list_name' => $this->getItemListName(),
            'item_variant'   => $this->getItemVariant(),
            'location_id'    => $this->getLocationId(),
            'price'          => $this->getPrice() ? round($this->getPrice(), 2) : null,
            'quantity'       => $this->getQuantity(),
        ]);
    }
}
