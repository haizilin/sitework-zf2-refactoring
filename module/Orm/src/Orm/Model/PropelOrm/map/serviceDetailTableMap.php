<?php

namespace Orm\Model\PropelOrm\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'service_detail' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.PropelOrm.map
 */
class serviceDetailTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelOrm.map.serviceDetailTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('service_detail');
        $this->setPhpName('serviceDetail');
        $this->setClassname('Orm\\Model\\PropelOrm\\serviceDetail');
        $this->setPackage('PropelOrm');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('FK_SERVICE_ID', 'FkServiceId', 'INTEGER' , 'service', 'ID', true, null, null);
        $this->addForeignPrimaryKey('FK_LANG_ID', 'FkLangId', 'INTEGER' , 'language', 'ID', true, null, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('service', 'Orm\\Model\\PropelOrm\\service', RelationMap::MANY_TO_ONE, array('fk_service_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('language', 'Orm\\Model\\PropelOrm\\language', RelationMap::MANY_TO_ONE, array('fk_lang_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // serviceDetailTableMap
