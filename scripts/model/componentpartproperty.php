<?php
/*
 * Copyright (C) 2016 Dream IP
 *
 * This file is part of GPStudio.
 *
 * GPStudio is a free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Multiple part flow could be used to define a part of a component
 * @brief ComponentPartProperty is the the graphical definition of a property
 * (position, part)
 * @see ComponentPart
 * @ingroup base
 */
class ComponentPartProperty
{
    /**
     * @brief Name of the property to draw
     * @var string $name
     */
    public $name;

    /**
     * @brief X position on schematic (optional)
     * @var int $x_pos
     */
    public $x_pos;

    /**
     * @brief Y position on schematic (optional)
     * @var int $y_pos
     */
    public $y_pos;

    /**
     * @brief width on schematic (optional)
     * @var int $width
     */
    public $width;

    /**
     * @brief height on schematic (optional)
     * @var int $height
     */
    public $height;

    /**
     * @brief Constructor of the class
     *
     * Build an empty ComponentPart if $xml is empty, fill it with $xml if set
     * @param SimpleXMLElement|null $xml XML element to parse if not null
     */
    function __construct($xml = null)
    {
        $this->x_pos = -1;
        $this->y_pos = -1;
        $this->width = -1;
        $this->height = -1;

        if ($xml)
            $this->parse_xml($xml);
    }

    /**
     * @brief internal function to fill this instance from input xml structure
     *
     * Can be call only from this node into the constructor
     * @param SimpleXMLElement $xml xml element to parse
     */
    protected function parse_xml($xml)
    {
        $this->name = (string) $xml['name'];

        if (isset($xml['x_pos']))
            $this->x_pos = (int) $xml['x_pos'];
        else
            $this->x_pos = -1;

        if (isset($xml['y_pos']))
            $this->y_pos = (int) $xml['y_pos'];
        else
            $this->y_pos = -1;

        if (isset($xml['width']))
            $this->width = (int) $xml['width'];
        else
            $this->width = -1;

        if (isset($xml['height']))
            $this->height = (int) $xml['height'];
        else
            $this->height = -1;
    }

    /**
     * @brief permits to output this instance
     *  
     * Return a formated node for the node_generated file. This method call all
     * the children getXmlElement to add into this node.
     * @param DOMDocument $xml reference of the output xml document
     * @param string $format desired output file format
     * @return DOMElement xml element corresponding to this current instance
     */
    public function getXmlElement($xml, $format)
    {
        $xml_element = $xml->createElement("property");

        // name
        $att = $xml->createAttribute('name');
        $att->value = $this->name;
        $xml_element->appendChild($att);

        // x_pos
        if (isset($this->x_pos) and $this->x_pos != -1)
        {
            $att = $xml->createAttribute('x_pos');
            $att->value = $this->x_pos;
            $xml_element->appendChild($att);
        }

        // y_pos
        if (isset($this->y_pos) and $this->y_pos != -1)
        {
            $att = $xml->createAttribute('y_pos');
            $att->value = $this->y_pos;
            $xml_element->appendChild($att);
        }
        
        // width
        if (isset($this->width) and $this->width != -1)
        {
            $att = $xml->createAttribute('width');
            $att->value = $this->width;
            $xml_element->appendChild($att);
        }
        
        // height
        if (isset($this->height) and $this->height != -1)
        {
            $att = $xml->createAttribute('height');
            $att->value = $this->height;
            $xml_element->appendChild($att);
        }

        return $xml_element;
    }
}
