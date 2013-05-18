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
use Orm\Model\PropelOrm\Category;
use Orm\Model\PropelOrm\Service;
use Orm\Model\PropelOrm\ServiceDetail;
use Orm\Model\PropelOrm\ServicePeer;
use Orm\Model\PropelOrm\ServiceQuery;

/**
 * Base class that represents a query for the 'service' table.
 *
 *
 *
 * @method ServiceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ServiceQuery orderByFkCategoryId($order = Criteria::ASC) Order by the fk_category_id column
 * @method ServiceQuery orderByPos($order = Criteria::ASC) Order by the pos column
 * @method ServiceQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method ServiceQuery groupById() Group by the id column
 * @method ServiceQuery groupByFkCategoryId() Group by the fk_category_id column
 * @method ServiceQuery groupByPos() Group by the pos column
 * @method ServiceQuery groupByActive() Group by the active column
 *
 * @method ServiceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ServiceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ServiceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ServiceQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method ServiceQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method ServiceQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method ServiceQuery leftJoinServiceDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServiceDetail relation
 * @method ServiceQuery rightJoinServiceDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServiceDetail relation
 * @method ServiceQuery innerJoinServiceDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the ServiceDetail relation
 *
 * @method Service findOne(PropelPDO $con = null) Return the first Service matching the query
 * @method Service findOneOrCreate(PropelPDO $con = null) Return the first Service matching the query, or a new Service object populated from the query conditions when no match is found
 *
 * @method Service findOneByFkCategoryId(int $fk_category_id) Return the first Service filtered by the fk_category_id column
 * @method Service findOneByPos(int $pos) Return the first Service filtered by the pos column
 * @method Service findOneByActive(boolean $active) Return the first Service filtered by the active column
 *
 * @method array findById(int $id) Return Service objects filtered by the id column
 * @method array findByFkCategoryId(int $fk_category_id) Return Service objects filtered by the fk_category_id column
 * @method array findByPos(int $pos) Return Service objects filtered by the pos column
 * @method array findByActive(boolean $active) Return Service objects filtered by the active column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseServiceQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseServiceQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'PropelOrm';
        }
        if (null === $modelName) {
            $modelName = 'Orm\\Model\\PropelOrm\\Service';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ServiceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ServiceQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ServiceQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ServiceQuery) {
            return $criteria;
        }
        $query = new ServiceQuery(null, null, $modelAlias);

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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Service|Service[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ServicePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Service A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Service A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `fk_category_id`, `pos`, `active` FROM `service` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Service();
            $obj->hydrate($row);
            ServicePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Service|Service[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Service[]|mixed the list of results, formatted by the current formatter
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
     * @return ServiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ServicePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ServicePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ServicePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ServicePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the fk_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCategoryId(1234); // WHERE fk_category_id = 1234
     * $query->filterByFkCategoryId(array(12, 34)); // WHERE fk_category_id IN (12, 34)
     * $query->filterByFkCategoryId(array('min' => 12)); // WHERE fk_category_id >= 12
     * $query->filterByFkCategoryId(array('max' => 12)); // WHERE fk_category_id <= 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $fkCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function filterByFkCategoryId($fkCategoryId = null, $comparison = null)
    {
        if (is_array($fkCategoryId)) {
            $useMinMax = false;
            if (isset($fkCategoryId['min'])) {
                $this->addUsingAlias(ServicePeer::FK_CATEGORY_ID, $fkCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCategoryId['max'])) {
                $this->addUsingAlias(ServicePeer::FK_CATEGORY_ID, $fkCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicePeer::FK_CATEGORY_ID, $fkCategoryId, $comparison);
    }

    /**
     * Filter the query on the pos column
     *
     * Example usage:
     * <code>
     * $query->filterByPos(1234); // WHERE pos = 1234
     * $query->filterByPos(array(12, 34)); // WHERE pos IN (12, 34)
     * $query->filterByPos(array('min' => 12)); // WHERE pos >= 12
     * $query->filterByPos(array('max' => 12)); // WHERE pos <= 12
     * </code>
     *
     * @param     mixed $pos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function filterByPos($pos = null, $comparison = null)
    {
        if (is_array($pos)) {
            $useMinMax = false;
            if (isset($pos['min'])) {
                $this->addUsingAlias(ServicePeer::POS, $pos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pos['max'])) {
                $this->addUsingAlias(ServicePeer::POS, $pos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicePeer::POS, $pos, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ServicePeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related Category object
     *
     * @param   Category|PropelObjectCollection $category The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ServiceQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof Category) {
            return $this
                ->addUsingAlias(ServicePeer::FK_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ServicePeer::FK_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type Category or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\Orm\Model\PropelOrm\CategoryQuery');
    }

    /**
     * Filter the query by a related ServiceDetail object
     *
     * @param   ServiceDetail|PropelObjectCollection $serviceDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ServiceQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByServiceDetail($serviceDetail, $comparison = null)
    {
        if ($serviceDetail instanceof ServiceDetail) {
            return $this
                ->addUsingAlias(ServicePeer::ID, $serviceDetail->getFkServiceId(), $comparison);
        } elseif ($serviceDetail instanceof PropelObjectCollection) {
            return $this
                ->useServiceDetailQuery()
                ->filterByPrimaryKeys($serviceDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByServiceDetail() only accepts arguments of type ServiceDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServiceDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function joinServiceDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServiceDetail');

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
            $this->addJoinObject($join, 'ServiceDetail');
        }

        return $this;
    }

    /**
     * Use the ServiceDetail relation ServiceDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\ServiceDetailQuery A secondary query class using the current class as primary query
     */
    public function useServiceDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinServiceDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServiceDetail', '\Orm\Model\PropelOrm\ServiceDetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Service $service Object to remove from the list of results
     *
     * @return ServiceQuery The current query, for fluid interface
     */
    public function prune($service = null)
    {
        if ($service) {
            $this->addUsingAlias(ServicePeer::ID, $service->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
