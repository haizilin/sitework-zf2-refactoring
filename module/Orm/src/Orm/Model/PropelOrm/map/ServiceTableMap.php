<?php

namespace Orm\Model\PropelOrm\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'service' table.
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
class ServiceTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'PropelOrm.map.ServiceTableMap';

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
		$this->setName('service');
		$this->setPhpName('Service');
		$this->setClassname('Orm\\Model\\PropelOrm\\Service');
		$this->setPackage('PropelOrm');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('FK_CATEGORY_ID', 'FkCategoryId', 'INTEGER', 'category', 'ID', true, null, null);
		$this->addColumn('POS', 'Pos', 'INTEGER', true, null, null);
		$this->addColumn('ACTIVE', 'Active', 'BOOLEAN', true, 1, true);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Category', 'Orm\\Model\\PropelOrm\\Category', RelationMap::MANY_TO_ONE, array('fk_category_id' => 'id', ), null, null);
		$this->addRelation('ServiceDetail', 'Orm\\Model\\PropelOrm\\ServiceDetail', RelationMap::ONE_TO_MANY, array('id' => 'fk_service_id', ), 'CASCADE', null, 'ServiceDetails');
	} // buildRelations()

} // ServiceTableMap
