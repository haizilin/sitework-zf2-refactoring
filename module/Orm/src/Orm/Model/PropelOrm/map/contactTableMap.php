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
class contactTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelOrm.map.contactTableMap';

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
        $this->setPhpName('contact');
        $this->setClassname('Orm\\Model\\PropelOrm\\contact');
        $this->setPackage('PropelOrm');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('LABEL', 'Label', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('projectRelatedByFkContactClientId', 'Orm\\Model\\PropelOrm\\project', RelationMap::ONE_TO_MANY, array('id' => 'fk_contact_client_id', ), null, null, 'projectsRelatedByFkContactClientId');
        $this->addRelation('projectRelatedByFkContactEmployerId', 'Orm\\Model\\PropelOrm\\project', RelationMap::ONE_TO_MANY, array('id' => 'fk_contact_employer_id', ), null, null, 'projectsRelatedByFkContactEmployerId');
    } // buildRelations()

} // contactTableMap
