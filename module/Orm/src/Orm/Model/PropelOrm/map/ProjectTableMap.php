<?php

namespace Orm\Model\PropelOrm\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project' table.
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
class ProjectTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelOrm.map.ProjectTableMap';

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
        $this->setName('project');
        $this->setPhpName('Project');
        $this->setClassname('Orm\\Model\\PropelOrm\\Project');
        $this->setPackage('PropelOrm');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_contact_client_id', 'FkContactClientId', 'INTEGER', 'contact', 'id', false, null, null);
        $this->addForeignKey('fk_contact_employer_id', 'FkContactEmployerId', 'INTEGER', 'contact', 'id', false, null, null);
        $this->addColumn('started_at', 'StartedAt', 'DATE', true, null, null);
        $this->addColumn('finished_at', 'FinishedAt', 'DATE', false, null, null);
        $this->addColumn('url', 'Url', 'VARCHAR', false, 255, null);
        $this->addColumn('img', 'Img', 'VARCHAR', false, 255, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, true);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ContactRelatedByFkContactClientId', 'Orm\\Model\\PropelOrm\\Contact', RelationMap::MANY_TO_ONE, array('fk_contact_client_id' => 'id', ), null, null);
        $this->addRelation('ContactRelatedByFkContactEmployerId', 'Orm\\Model\\PropelOrm\\Contact', RelationMap::MANY_TO_ONE, array('fk_contact_employer_id' => 'id', ), null, null);
        $this->addRelation('ProjectDetail', 'Orm\\Model\\PropelOrm\\ProjectDetail', RelationMap::ONE_TO_MANY, array('id' => 'fk_project_id', ), null, null, 'ProjectDetails');
    } // buildRelations()

} // ProjectTableMap
