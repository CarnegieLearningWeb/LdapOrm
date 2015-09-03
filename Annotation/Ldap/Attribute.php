<?php
/***************************************************************************
 * Copyright (C) 1999-2012 Gadz.org                                        *
 * http://opensource.gadz.org/                                             *
 *                                                                         *
 * This program is free software; you can redistribute it and/or modify    *
 * it under the terms of the GNU General Public License as published by    *
 * the Free Software Foundation; either version 2 of the License, or       *
 * (at your option) any later version.                                     *
 *                                                                         *
 * This program is distributed in the hope that it will be useful,         *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of          *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the            *
 * GNU General Public License for more details.                            *
 *                                                                         *
 * You should have received a copy of the GNU General Public License       *
 * along with this program; if not, write to the Free Software             *
 * Foundation, Inc.,                                                       *
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA                   *
 ***************************************************************************/
 
namespace Ucsf\LdapOrmBundle\Annotation\Ldap;

/**
 * Annotation to describe an Ldap objectClass
 * 
 * @Annotation
 * @author Mathieu GOULIN <mathieu.goulin@gadz.org>
 */
final class Attribute
{
    private $name;
    private $isOperational = false;

    /**
     * Build the Attribute object
     * 
     * @param array $data
     * 
     * @throws \BadMethodCallException
     */
    public function __construct(array $data)
    {
        // Treatment of annotation data
        if (isset($data['value'])) {
            $this->name = $data['value'];
            unset($data['value']);
        }

        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (!method_exists($this, $method)) {
                throw new \BadMethodCallException(sprintf("Unknown property '%s' on annotation '%s'.", $key, get_class($this)));
            }
            $this->$method($value);
        }
    }

    /**
     * Return the name of the Attribute
     * 
     *  @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the Attribute's name
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setIsOperational($status) {
        $this->isOperational = $status;
    }

    public function getIsOperational() {
        return $this->isOperational;
    }
}
