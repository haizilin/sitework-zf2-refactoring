<?php

namespace Orm\Model\PropelOrm\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'contact' table.
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
class ContactTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelOrm.map.ContactTableMap';

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
        $this->setName('contact');
        $this->setPhpName('Contact');
        $this->setClassname('Orm\\Model\\PropelOrm\\Contact');
        $this->setPackage('PropelOrm');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('label', 'Label', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ProjectRelatedByFkContactClientId', 'Orm\\Model\\PropelOrm\\Project', RelationMap::ONE_TO_MANY, array('id' => 'fk_contact_client_id', ), null, null, 'ProjectsRelatedByFkContactClientId');
        $this->addRelation('ProjectRelatedByFkContactEmployerId', 'Orm\\Model\\PropelOrm\\Project', RelationMap::ONE_TO_MANY, array('id' => 'fk_contact_employer_id', ), null, null, 'ProjectsRelatedByFkContactEmployerId');
    } // buildRelations()

} // ContactTableMap
