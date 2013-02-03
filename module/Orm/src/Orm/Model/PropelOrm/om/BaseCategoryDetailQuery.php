<?php

namespace Orm\Model\PropelOrm\om;

use \Criteria;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelPDO;
use Orm\Model\PropelOrm\CategoryDetail;
use Orm\Model\PropelOrm\CategoryDetailPeer;
use Orm\Model\PropelOrm\CategoryDetailQuery;
use Orm\Model\PropelOrm\Language;

/**
 * Base class that represents a query for the 'category_detail' table.
 *
 * 
 *
 * @method     CategoryDetailQuery orderByFkCategoryId($order = Criteria::ASC) Order by the fk_category_id column
 * @method     CategoryDetailQuery orderByFkLangId($order = Criteria::ASC) Order by the fk_lang_id column
 * @method     CategoryDetailQuery orderByLabel($order = Criteria::ASC) Order by the label column
 *
 * @method     CategoryDetailQuery groupByFkCategoryId() Group by the fk_category_id column
 * @method     CategoryDetailQuery groupByFkLangId() Group by the fk_lang_id column
 * @method     CategoryDetailQuery groupByLabel() Group by the label column
 *
 * @method     CategoryDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CategoryDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CategoryDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CategoryDetailQuery leftJoinLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Language relation
 * @method     CategoryDetailQuery rightJoinLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Language relation
 * @method     CategoryDetailQuery innerJoinLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the Language relation
 *
 * @method     CategoryDetail findOne(PropelPDO $con = null) Return the first CategoryDetail matching the query
 * @method     CategoryDetail findOneOrCreate(PropelPDO $con = null) Return the first CategoryDetail matching the query, or a new CategoryDetail object populated from the query conditions when no match is found
 *
 * @method     CategoryDetail findOneByFkCategoryId(int $fk_category_id) Return the first CategoryDetail filtered by the fk_category_id column
 * @method     CategoryDetail findOneByFkLangId(int $fk_lang_id) Return the first CategoryDetail filtered by the fk_lang_id column
 * @method     CategoryDetail findOneByLabel(string $label) Return the first CategoryDetail filtered by the label column
 *
 * @method     array findByFkCategoryId(int $fk_category_id) Return CategoryDetail objects filtered by the fk_category_id column
 * @method     array findByFkLangId(int $fk_lang_id) Return CategoryDetail objects filtered by the fk_lang_id column
 * @method     array findByLabel(string $label) Return CategoryDetail objects filtered by the label column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseCategoryDetailQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseCategoryDetailQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\CategoryDetail', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CategoryDetailQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CategoryDetailQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CategoryDetailQuery) {
			return $criteria;
		}
		$query = new CategoryDetailQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 *
	 * @param     array[$fk_category_id, $fk_lang_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    CategoryDetail|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = CategoryDetailPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(CategoryDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    CategoryDetail A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `FK_CATEGORY_ID`, `FK_LANG_ID`, `LABEL` FROM `category_detail` WHERE `FK_CATEGORY_ID` = :p0 AND `FK_LANG_ID` = :p1';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
			$stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new CategoryDetail();
			$obj->hydrate($row);
			CategoryDetailPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    CategoryDetail|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(CategoryDetailPeer::FK_CATEGORY_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(CategoryDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(CategoryDetailPeer::FK_CATEGORY_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(CategoryDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the fk_category_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFkCategoryId(1234); // WHERE fk_category_id = 1234
	 * $query->filterByFkCategoryId(array(12, 34)); // WHERE fk_category_id IN (12, 34)
	 * $query->filterByFkCategoryId(array('min' => 12)); // WHERE fk_category_id > 12
	 * </code>
	 *
	 * @param     mixed $fkCategoryId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function filterByFkCategoryId($fkCategoryId = null, $comparison = null)
	{
		if (is_array($fkCategoryId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CategoryDetailPeer::FK_CATEGORY_ID, $fkCategoryId, $comparison);
	}

	/**
	 * Filter the query on the fk_lang_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFkLangId(1234); // WHERE fk_lang_id = 1234
	 * $query->filterByFkLangId(array(12, 34)); // WHERE fk_lang_id IN (12, 34)
	 * $query->filterByFkLangId(array('min' => 12)); // WHERE fk_lang_id > 12
	 * </code>
	 *
	 * @see       filterByLanguage()
	 *
	 * @param     mixed $fkLangId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function filterByFkLangId($fkLangId = null, $comparison = null)
	{
		if (is_array($fkLangId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CategoryDetailPeer::FK_LANG_ID, $fkLangId, $comparison);
	}

	/**
	 * Filter the query on the label column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
	 * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $label The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function filterByLabel($label = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($label)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $label)) {
				$label = str_replace('*', '%', $label);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CategoryDetailPeer::LABEL, $label, $comparison);
	}

	/**
	 * Filter the query by a related Language object
	 *
	 * @param     Language|PropelCollection $language The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function filterByLanguage($language, $comparison = null)
	{
		if ($language instanceof Language) {
			return $this
				->addUsingAlias(CategoryDetailPeer::FK_LANG_ID, $language->getId(), $comparison);
		} elseif ($language instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CategoryDetailPeer::FK_LANG_ID, $language->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByLanguage() only accepts arguments of type Language or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Language relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function joinLanguage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Language');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Language');
		}

		return $this;
	}

	/**
	 * Use the Language relation Language object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \Orm\Model\PropelOrm\LanguageQuery A secondary query class using the current class as primary query
	 */
	public function useLanguageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinLanguage($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Language', '\Orm\Model\PropelOrm\LanguageQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     CategoryDetail $categoryDetail Object to remove from the list of results
	 *
	 * @return    CategoryDetailQuery The current query, for fluid interface
	 */
	public function prune($categoryDetail = null)
	{
		if ($categoryDetail) {
			$this->addCond('pruneCond0', $this->getAliasedColName(CategoryDetailPeer::FK_CATEGORY_ID), $categoryDetail->getFkCategoryId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(CategoryDetailPeer::FK_LANG_ID), $categoryDetail->getFkLangId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseCategoryDetailQuery