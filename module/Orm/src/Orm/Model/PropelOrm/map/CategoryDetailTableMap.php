<?php

namespace Orm\Model\PropelOrm\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'category_detail' table.
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
class CategoryDetailTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'PropelOrm.map.CategoryDetailTableMap';

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
		$this->setName('category_detail');
		$this->setPhpName('CategoryDetail');
		$this->setClassname('Orm\\Model\\PropelOrm\\CategoryDetail');
		$this->setPackage('PropelOrm');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('FK_CATEGORY_ID', 'FkCategoryId', 'INTEGER', true, null, null);
		$this->addForeignPrimaryKey('FK_LANG_ID', 'FkLangId', 'INTEGER' , 'language', 'ID', true, null, null);
		$this->addColumn('LABEL', 'Label', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Language', 'Orm\\Model\\PropelOrm\\Language', RelationMap::MANY_TO_ONE, array('fk_lang_id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // CategoryDetailTableMap
