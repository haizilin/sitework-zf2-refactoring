<?php

namespace Orm\Model\PropelOrm\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Orm\Model\PropelOrm\language;
use Orm\Model\PropelOrm\service;
use Orm\Model\PropelOrm\serviceDetail;
use Orm\Model\PropelOrm\serviceDetailPeer;
use Orm\Model\PropelOrm\serviceDetailQuery;

/**
 * Base class that represents a query for the 'service_detail' table.
 *
 *
 *
 * @method serviceDetailQuery orderByFkServiceId($order = Criteria::ASC) Order by the fk_service_id column
 * @method serviceDetailQuery orderByFkLangId($order = Criteria::ASC) Order by the fk_lang_id column
 * @method serviceDetailQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method serviceDetailQuery groupByFkServiceId() Group by the fk_service_id column
 * @method serviceDetailQuery groupByFkLangId() Group by the fk_lang_id column
 * @method serviceDetailQuery groupByDescription() Group by the description column
 *
 * @method serviceDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method serviceDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method serviceDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method serviceDetailQuery leftJoinservice($relationAlias = null) Adds a LEFT JOIN clause to the query using the service relation
 * @method serviceDetailQuery rightJoinservice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the service relation
 * @method serviceDetailQuery innerJoinservice($relationAlias = null) Adds a INNER JOIN clause to the query using the service relation
 *
 * @method serviceDetailQuery leftJoinlanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the language relation
 * @method serviceDetailQuery rightJoinlanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the language relation
 * @method serviceDetailQuery innerJoinlanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the language relation
 *
 * @method serviceDetail findOne(PropelPDO $con = null) Return the first serviceDetail matching the query
 * @method serviceDetail findOneOrCreate(PropelPDO $con = null) Return the first serviceDetail matching the query, or a new serviceDetail object populated from the query conditions when no match is found
 *
 * @method serviceDetail findOneByFkServiceId(int $fk_service_id) Return the first serviceDetail filtered by the fk_service_id column
 * @method serviceDetail findOneByFkLangId(int $fk_lang_id) Return the first serviceDetail filtered by the fk_lang_id column
 * @method serviceDetail findOneByDescription(string $description) Return the first serviceDetail filtered by the description column
 *
 * @method array findByFkServiceId(int $fk_service_id) Return serviceDetail objects filtered by the fk_service_id column
 * @method array findByFkLangId(int $fk_lang_id) Return serviceDetail objects filtered by the fk_lang_id column
 * @method array findByDescription(string $description) Return serviceDetail objects filtered by the description column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseserviceDetailQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseserviceDetailQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\serviceDetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new serviceDetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     serviceDetailQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return serviceDetailQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof serviceDetailQuery) {
            return $criteria;
        }
        $query = new serviceDetailQuery();
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
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$fk_service_id, $fk_lang_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   serviceDetail|serviceDetail[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = serviceDetailPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(serviceDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   serviceDetail A model object, or null if the key is not found
     * @throws   PropelException
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
            $obj = new serviceDetail();
            $obj->hydrate($row);
            serviceDetailPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return serviceDetail|serviceDetail[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|serviceDetail[]|mixed the list of results, formatted by the current formatter
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
     * @return serviceDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(serviceDetailPeer::FK_SERVICE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(serviceDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return serviceDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(serviceDetailPeer::FK_SERVICE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(serviceDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);
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
     * @see       filterByservice()
     *
     * @param     mixed $fkServiceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return serviceDetailQuery The current query, for fluid interface
     */
    public function filterByFkServiceId($fkServiceId = null, $comparison = null)
    {
        if (is_array($fkServiceId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(serviceDetailPeer::FK_SERVICE_ID, $fkServiceId, $comparison);
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
     * @see       filterBylanguage()
     *
     * @param     mixed $fkLangId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return serviceDetailQuery The current query, for fluid interface
     */
    public function filterByFkLangId($fkLangId = null, $comparison = null)
    {
        if (is_array($fkLangId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(serviceDetailPeer::FK_LANG_ID, $fkLangId, $comparison);
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
     * @return serviceDetailQuery The current query, for fluid interface
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

        return $this->addUsingAlias(serviceDetailPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related service object
     *
     * @param   service|PropelObjectCollection $service The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   serviceDetailQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByservice($service, $comparison = null)
    {
        if ($service instanceof service) {
            return $this
                ->addUsingAlias(serviceDetailPeer::FK_SERVICE_ID, $service->getId(), $comparison);
        } elseif ($service instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(serviceDetailPeer::FK_SERVICE_ID, $service->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByservice() only accepts arguments of type service or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the service relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return serviceDetailQuery The current query, for fluid interface
     */
    public function joinservice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('service');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'service');
        }

        return $this;
    }

    /**
     * Use the service relation service object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\serviceQuery A secondary query class using the current class as primary query
     */
    public function useserviceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinservice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'service', '\Orm\Model\PropelOrm\serviceQuery');
    }

    /**
     * Filter the query by a related language object
     *
     * @param   language|PropelObjectCollection $language The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   serviceDetailQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBylanguage($language, $comparison = null)
    {
        if ($language instanceof language) {
            return $this
                ->addUsingAlias(serviceDetailPeer::FK_LANG_ID, $language->getId(), $comparison);
        } elseif ($language instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(serviceDetailPeer::FK_LANG_ID, $language->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBylanguage() only accepts arguments of type language or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the language relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return serviceDetailQuery The current query, for fluid interface
     */
    public function joinlanguage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('language');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'language');
        }

        return $this;
    }

    /**
     * Use the language relation language object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\languageQuery A secondary query class using the current class as primary query
     */
    public function uselanguageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinlanguage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'language', '\Orm\Model\PropelOrm\languageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   serviceDetail $serviceDetail Object to remove from the list of results
     *
     * @return serviceDetailQuery The current query, for fluid interface
     */
    public function prune($serviceDetail = null)
    {
        if ($serviceDetail) {
            $this->addCond('pruneCond0', $this->getAliasedColName(serviceDetailPeer::FK_SERVICE_ID), $serviceDetail->getFkServiceId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(serviceDetailPeer::FK_LANG_ID), $serviceDetail->getFkLangId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
