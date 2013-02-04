<?php

namespace Orm\Model\PropelOrm\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project_detail' table.
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
class projectDetailTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelOrm.map.projectDetailTableMap';

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
        $this->setName('project_detail');
        $this->setPhpName('projectDetail');
        $this->setClassname('Orm\\Model\\PropelOrm\\projectDetail');
        $this->setPackage('PropelOrm');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('FK_PROJECT_ID', 'FkProjectId', 'INTEGER' , 'project', 'ID', true, null, null);
        $this->addForeignPrimaryKey('FK_LANG_ID', 'FkLangId', 'INTEGER' , 'language', 'ID', true, null, null);
        $this->addColumn('LABEL', 'Label', 'VARCHAR', true, 255, null);
        $this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('project', 'Orm\\Model\\PropelOrm\\project', RelationMap::MANY_TO_ONE, array('fk_project_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('language', 'Orm\\Model\\PropelOrm\\language', RelationMap::MANY_TO_ONE, array('fk_lang_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // projectDetailTableMap
