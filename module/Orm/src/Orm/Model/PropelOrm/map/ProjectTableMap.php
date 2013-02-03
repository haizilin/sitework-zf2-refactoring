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
	 * @return     void
	 * @throws     PropelException
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
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('FK_CONTACT_CLIENT_ID', 'FkContactClientId', 'INTEGER', 'contact', 'ID', false, null, null);
		$this->addForeignKey('FK_CONTACT_EMPLOYER_ID', 'FkContactEmployerId', 'INTEGER', 'contact', 'ID', false, null, null);
		$this->addColumn('STARTED_AT', 'StartedAt', 'DATE', true, null, null);
		$this->addColumn('FINISHED_AT', 'FinishedAt', 'DATE', false, null, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', false, 255, null);
		$this->addColumn('IMG', 'Img', 'VARCHAR', false, 255, null);
		$this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, 1, true);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('ContactRelatedByFkContactClientId', 'Orm\\Model\\PropelOrm\\Contact', RelationMap::MANY_TO_ONE, array('fk_contact_client_id' => 'id', ), null, null);
		$this->addRelation('ContactRelatedByFkContactEmployerId', 'Orm\\Model\\PropelOrm\\Contact', RelationMap::MANY_TO_ONE, array('fk_contact_employer_id' => 'id', ), null, null);
		$this->addRelation('ProjectDetail', 'Orm\\Model\\PropelOrm\\ProjectDetail', RelationMap::ONE_TO_MANY, array('id' => 'fk_project_id', ), 'CASCADE', null, 'ProjectDetails');
	} // buildRelations()

} // ProjectTableMap
