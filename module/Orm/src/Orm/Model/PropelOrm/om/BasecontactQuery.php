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
use Orm\Model\PropelOrm\contact;
use Orm\Model\PropelOrm\contactPeer;
use Orm\Model\PropelOrm\contactQuery;
use Orm\Model\PropelOrm\project;

/**
 * Base class that represents a query for the 'contact' table.
 *
 *
 *
 * @method contactQuery orderById($order = Criteria::ASC) Order by the id column
 * @method contactQuery orderByLabel($order = Criteria::ASC) Order by the label column
 *
 * @method contactQuery groupById() Group by the id column
 * @method contactQuery groupByLabel() Group by the label column
 *
 * @method contactQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method contactQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method contactQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method contactQuery leftJoinprojectRelatedByFkContactClientId($relationAlias = null) Adds a LEFT JOIN clause to the query using the projectRelatedByFkContactClientId relation
 * @method contactQuery rightJoinprojectRelatedByFkContactClientId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the projectRelatedByFkContactClientId relation
 * @method contactQuery innerJoinprojectRelatedByFkContactClientId($relationAlias = null) Adds a INNER JOIN clause to the query using the projectRelatedByFkContactClientId relation
 *
 * @method contactQuery leftJoinprojectRelatedByFkContactEmployerId($relationAlias = null) Adds a LEFT JOIN clause to the query using the projectRelatedByFkContactEmployerId relation
 * @method contactQuery rightJoinprojectRelatedByFkContactEmployerId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the projectRelatedByFkContactEmployerId relation
 * @method contactQuery innerJoinprojectRelatedByFkContactEmployerId($relationAlias = null) Adds a INNER JOIN clause to the query using the projectRelatedByFkContactEmployerId relation
 *
 * @method contact findOne(PropelPDO $con = null) Return the first contact matching the query
 * @method contact findOneOrCreate(PropelPDO $con = null) Return the first contact matching the query, or a new contact object populated from the query conditions when no match is found
 *
 * @method contact findOneById(int $id) Return the first contact filtered by the id column
 * @method contact findOneByLabel(string $label) Return the first contact filtered by the label column
 *
 * @method array findById(int $id) Return contact objects filtered by the id column
 * @method array findByLabel(string $label) Return contact objects filtered by the label column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BasecontactQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasecontactQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\contact', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new contactQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     contactQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return contactQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof contactQuery) {
            return $criteria;
        }
        $query = new contactQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   contact|contact[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = contactPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(contactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   contact A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `LABEL` FROM `contact` WHERE `ID` = :p0';
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
            $obj = new contact();
            $obj->hydrate($row);
            contactPeer::addInstanceToPool($obj, (string) $key);
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
     * @return contact|contact[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|contact[]|mixed the list of results, formatted by the current formatter
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
     * @return contactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(contactPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return contactQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(contactPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return contactQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(contactPeer::ID, $id, $comparison);
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
     * @return contactQuery The current query, for fluid interface
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

        return $this->addUsingAlias(contactPeer::LABEL, $label, $comparison);
    }

    /**
     * Filter the query by a related project object
     *
     * @param   project|PropelObjectCollection $project  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   contactQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByprojectRelatedByFkContactClientId($project, $comparison = null)
    {
        if ($project instanceof project) {
            return $this
                ->addUsingAlias(contactPeer::ID, $project->getFkContactClientId(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            return $this
                ->useprojectRelatedByFkContactClientIdQuery()
                ->filterByPrimaryKeys($project->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByprojectRelatedByFkContactClientId() only accepts arguments of type project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the projectRelatedByFkContactClientId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return contactQuery The current query, for fluid interface
     */
    public function joinprojectRelatedByFkContactClientId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('projectRelatedByFkContactClientId');

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
            $this->addJoinObject($join, 'projectRelatedByFkContactClientId');
        }

        return $this;
    }

    /**
     * Use the projectRelatedByFkContactClientId relation project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\projectQuery A secondary query class using the current class as primary query
     */
    public function useprojectRelatedByFkContactClientIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinprojectRelatedByFkContactClientId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'projectRelatedByFkContactClientId', '\Orm\Model\PropelOrm\projectQuery');
    }

    /**
     * Filter the query by a related project object
     *
     * @param   project|PropelObjectCollection $project  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   contactQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByprojectRelatedByFkContactEmployerId($project, $comparison = null)
    {
        if ($project instanceof project) {
            return $this
                ->addUsingAlias(contactPeer::ID, $project->getFkContactEmployerId(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            return $this
                ->useprojectRelatedByFkContactEmployerIdQuery()
                ->filterByPrimaryKeys($project->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByprojectRelatedByFkContactEmployerId() only accepts arguments of type project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the projectRelatedByFkContactEmployerId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return contactQuery The current query, for fluid interface
     */
    public function joinprojectRelatedByFkContactEmployerId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('projectRelatedByFkContactEmployerId');

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
            $this->addJoinObject($join, 'projectRelatedByFkContactEmployerId');
        }

        return $this;
    }

    /**
     * Use the projectRelatedByFkContactEmployerId relation project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\projectQuery A secondary query class using the current class as primary query
     */
    public function useprojectRelatedByFkContactEmployerIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinprojectRelatedByFkContactEmployerId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'projectRelatedByFkContactEmployerId', '\Orm\Model\PropelOrm\projectQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   contact $contact Object to remove from the list of results
     *
     * @return contactQuery The current query, for fluid interface
     */
    public function prune($contact = null)
    {
        if ($contact) {
            $this->addUsingAlias(contactPeer::ID, $contact->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
