<?php

namespace Orm\Model\PropelOrm\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'language' table.
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
class LanguageTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelOrm.map.LanguageTableMap';

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
        $this->setName('language');
        $this->setPhpName('Language');
        $this->setClassname('Orm\\Model\\PropelOrm\\Language');
        $this->setPackage('PropelOrm');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('locale', 'Locale', 'VARCHAR', true, 5, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, true);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CategoryDetail', 'Orm\\Model\\PropelOrm\\CategoryDetail', RelationMap::ONE_TO_MANY, array('id' => 'fk_lang_id', ), null, null, 'CategoryDetails');
        $this->addRelation('ServiceDetail', 'Orm\\Model\\PropelOrm\\ServiceDetail', RelationMap::ONE_TO_MANY, array('id' => 'fk_lang_id', ), null, null, 'ServiceDetails');
        $this->addRelation('ProjectDetail', 'Orm\\Model\\PropelOrm\\ProjectDetail', RelationMap::ONE_TO_MANY, array('id' => 'fk_lang_id', ), null, null, 'ProjectDetails');
    } // buildRelations()

} // LanguageTableMap
