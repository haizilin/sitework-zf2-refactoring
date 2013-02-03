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
use Orm\Model\PropelOrm\Language;
use Orm\Model\PropelOrm\Service;
use Orm\Model\PropelOrm\ServiceDetail;
use Orm\Model\PropelOrm\ServiceDetailPeer;
use Orm\Model\PropelOrm\ServiceDetailQuery;

/**
 * Base class that represents a query for the 'service_detail' table.
 *
 * 
 *
 * @method     ServiceDetailQuery orderByFkServiceId($order = Criteria::ASC) Order by the fk_service_id column
 * @method     ServiceDetailQuery orderByFkLangId($order = Criteria::ASC) Order by the fk_lang_id column
 * @method     ServiceDetailQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ServiceDetailQuery groupByFkServiceId() Group by the fk_service_id column
 * @method     ServiceDetailQuery groupByFkLangId() Group by the fk_lang_id column
 * @method     ServiceDetailQuery groupByDescription() Group by the description column
 *
 * @method     ServiceDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ServiceDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ServiceDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ServiceDetailQuery leftJoinService($relationAlias = null) Adds a LEFT JOIN clause to the query using the Service relation
 * @method     ServiceDetailQuery rightJoinService($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Service relation
 * @method     ServiceDetailQuery innerJoinService($relationAlias = null) Adds a INNER JOIN clause to the query using the Service relation
 *
 * @method     ServiceDetailQuery leftJoinLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Language relation
 * @method     ServiceDetailQuery rightJoinLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Language relation
 * @method     ServiceDetailQuery innerJoinLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the Language relation
 *
 * @method     ServiceDetail findOne(PropelPDO $con = null) Return the first ServiceDetail matching the query
 * @method     ServiceDetail findOneOrCreate(PropelPDO $con = null) Return the first ServiceDetail matching the query, or a new ServiceDetail object populated from the query conditions when no match is found
 *
 * @method     ServiceDetail findOneByFkServiceId(int $fk_service_id) Return the first ServiceDetail filtered by the fk_service_id column
 * @method     ServiceDetail findOneByFkLangId(int $fk_lang_id) Return the first ServiceDetail filtered by the fk_lang_id column
 * @method     ServiceDetail findOneByDescription(string $description) Return the first ServiceDetail filtered by the description column
 *
 * @method     array findByFkServiceId(int $fk_service_id) Return ServiceDetail objects filtered by the fk_service_id column
 * @method     array findByFkLangId(int $fk_lang_id) Return ServiceDetail objects filtered by the fk_lang_id column
 * @method     array findByDescription(string $description) Return ServiceDetail objects filtered by the description column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseServiceDetailQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseServiceDetailQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\ServiceDetail', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ServiceDetailQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ServiceDetailQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ServiceDetailQuery) {
			return $criteria;
		}
		$query = new ServiceDetailQuery();
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
	 * @param     array[$fk_service_id, $fk_lang_id] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ServiceDetail|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ServiceDetailPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ServiceDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    ServiceDetail A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `FK_SERVICE_ID`, `FK_LANG_ID`, `DESCRIPTION` FROM `service_detail` WHERE `FK_SERVICE_ID` = :p0 AND `FK_LANG_ID` = :p1';
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
			$obj = new ServiceDetail();
			$obj->hydrate($row);
			ServiceDetailPeer::addInstanceToPool($obj, serialize(array((string) $row[0], (string) $row[1])));
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
	 * @return    ServiceDetail|array|mixed the result, formatted by the current formatter
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
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ServiceDetailPeer::FK_SERVICE_ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ServiceDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);

		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ServiceDetailPeer::FK_SERVICE_ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ServiceDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}

		return $this;
	}

	/**
	 * Filter the query on the fk_service_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFkServiceId(1234); // WHERE fk_service_id = 1234
	 * $query->filterByFkServiceId(array(12, 34)); // WHERE fk_service_id IN (12, 34)
	 * $query->filterByFkServiceId(array('min' => 12)); // WHERE fk_service_id > 12
	 * </code>
	 *
	 * @see       filterByService()
	 *
	 * @param     mixed $fkServiceId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function filterByFkServiceId($fkServiceId = null, $comparison = null)
	{
		if (is_array($fkServiceId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ServiceDetailPeer::FK_SERVICE_ID, $fkServiceId, $comparison);
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
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function filterByFkLangId($fkLangId = null, $comparison = null)
	{
		if (is_array($fkLangId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ServiceDetailPeer::FK_LANG_ID, $fkLangId, $comparison);
	}

	/**
	 * Filter the query on the description column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
	 * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $description The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ServiceDetailPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query by a related Service object
	 *
	 * @param     Service|PropelCollection $service The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function filterByService($service, $comparison = null)
	{
		if ($service instanceof Service) {
			return $this
				->addUsingAlias(ServiceDetailPeer::FK_SERVICE_ID, $service->getId(), $comparison);
		} elseif ($service instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ServiceDetailPeer::FK_SERVICE_ID, $service->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByService() only accepts arguments of type Service or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Service relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function joinService($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Service');

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
			$this->addJoinObject($join, 'Service');
		}

		return $this;
	}

	/**
	 * Use the Service relation Service object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    \Orm\Model\PropelOrm\ServiceQuery A secondary query class using the current class as primary query
	 */
	public function useServiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinService($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Service', '\Orm\Model\PropelOrm\ServiceQuery');
	}

	/**
	 * Filter the query by a related Language object
	 *
	 * @param     Language|PropelCollection $language The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function filterByLanguage($language, $comparison = null)
	{
		if ($language instanceof Language) {
			return $this
				->addUsingAlias(ServiceDetailPeer::FK_LANG_ID, $language->getId(), $comparison);
		} elseif ($language instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ServiceDetailPeer::FK_LANG_ID, $language->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ServiceDetailQuery The current query, for fluid interface
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
	 * @param     ServiceDetail $serviceDetail Object to remove from the list of results
	 *
	 * @return    ServiceDetailQuery The current query, for fluid interface
	 */
	public function prune($serviceDetail = null)
	{
		if ($serviceDetail) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ServiceDetailPeer::FK_SERVICE_ID), $serviceDetail->getFkServiceId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ServiceDetailPeer::FK_LANG_ID), $serviceDetail->getFkLangId(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
		}

		return $this;
	}

} // BaseServiceDetailQuery