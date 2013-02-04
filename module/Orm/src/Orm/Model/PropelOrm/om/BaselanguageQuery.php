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
use Orm\Model\PropelOrm\categoryDetail;
use Orm\Model\PropelOrm\language;
use Orm\Model\PropelOrm\languagePeer;
use Orm\Model\PropelOrm\languageQuery;
use Orm\Model\PropelOrm\projectDetail;
use Orm\Model\PropelOrm\serviceDetail;

/**
 * Base class that represents a query for the 'language' table.
 *
 *
 *
 * @method languageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method languageQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method languageQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method languageQuery groupById() Group by the id column
 * @method languageQuery groupByLocale() Group by the locale column
 * @method languageQuery groupByActive() Group by the active column
 *
 * @method languageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method languageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method languageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method languageQuery leftJoincategoryDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the categoryDetail relation
 * @method languageQuery rightJoincategoryDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the categoryDetail relation
 * @method languageQuery innerJoincategoryDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the categoryDetail relation
 *
 * @method languageQuery leftJoinserviceDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the serviceDetail relation
 * @method languageQuery rightJoinserviceDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the serviceDetail relation
 * @method languageQuery innerJoinserviceDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the serviceDetail relation
 *
 * @method languageQuery leftJoinprojectDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the projectDetail relation
 * @method languageQuery rightJoinprojectDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the projectDetail relation
 * @method languageQuery innerJoinprojectDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the projectDetail relation
 *
 * @method language findOne(PropelPDO $con = null) Return the first language matching the query
 * @method language findOneOrCreate(PropelPDO $con = null) Return the first language matching the query, or a new language object populated from the query conditions when no match is found
 *
 * @method language findOneById(int $id) Return the first language filtered by the id column
 * @method language findOneByLocale(string $locale) Return the first language filtered by the locale column
 * @method language findOneByActive(boolean $active) Return the first language filtered by the active column
 *
 * @method array findById(int $id) Return language objects filtered by the id column
 * @method array findByLocale(string $locale) Return language objects filtered by the locale column
 * @method array findByActive(boolean $active) Return language objects filtered by the active column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaselanguageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaselanguageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\language', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new languageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     languageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return languageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof languageQuery) {
            return $criteria;
        }
        $query = new languageQuery();
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
     * @return   language|language[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = languagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(languagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   language A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `LOCALE`, `ACTIVE` FROM `language` WHERE `ID` = :p0';
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
            $obj = new language();
            $obj->hydrate($row);
            languagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return language|language[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|language[]|mixed the list of results, formatted by the current formatter
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
     * @return languageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(languagePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return languageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(languagePeer::ID, $keys, Criteria::IN);
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
     * @return languageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(languagePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return languageQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(languagePeer::LOCALE, $locale, $comparison);
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
     * @return languageQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(languagePeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related categoryDetail object
     *
     * @param   categoryDetail|PropelObjectCollection $categoryDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   languageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBycategoryDetail($categoryDetail, $comparison = null)
    {
        if ($categoryDetail instanceof categoryDetail) {
            return $this
                ->addUsingAlias(languagePeer::ID, $categoryDetail->getFkLangId(), $comparison);
        } elseif ($categoryDetail instanceof PropelObjectCollection) {
            return $this
                ->usecategoryDetailQuery()
                ->filterByPrimaryKeys($categoryDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBycategoryDetail() only accepts arguments of type categoryDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the categoryDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return languageQuery The current query, for fluid interface
     */
    public function joincategoryDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('categoryDetail');

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
            $this->addJoinObject($join, 'categoryDetail');
        }

        return $this;
    }

    /**
     * Use the categoryDetail relation categoryDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\categoryDetailQuery A secondary query class using the current class as primary query
     */
    public function usecategoryDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joincategoryDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'categoryDetail', '\Orm\Model\PropelOrm\categoryDetailQuery');
    }

    /**
     * Filter the query by a related serviceDetail object
     *
     * @param   serviceDetail|PropelObjectCollection $serviceDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   languageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByserviceDetail($serviceDetail, $comparison = null)
    {
        if ($serviceDetail instanceof serviceDetail) {
            return $this
                ->addUsingAlias(languagePeer::ID, $serviceDetail->getFkLangId(), $comparison);
        } elseif ($serviceDetail instanceof PropelObjectCollection) {
            return $this
                ->useserviceDetailQuery()
                ->filterByPrimaryKeys($serviceDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByserviceDetail() only accepts arguments of type serviceDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the serviceDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return languageQuery The current query, for fluid interface
     */
    public function joinserviceDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('serviceDetail');

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
            $this->addJoinObject($join, 'serviceDetail');
        }

        return $this;
    }

    /**
     * Use the serviceDetail relation serviceDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\serviceDetailQuery A secondary query class using the current class as primary query
     */
    public function useserviceDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinserviceDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'serviceDetail', '\Orm\Model\PropelOrm\serviceDetailQuery');
    }

    /**
     * Filter the query by a related projectDetail object
     *
     * @param   projectDetail|PropelObjectCollection $projectDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   languageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByprojectDetail($projectDetail, $comparison = null)
    {
        if ($projectDetail instanceof projectDetail) {
            return $this
                ->addUsingAlias(languagePeer::ID, $projectDetail->getFkLangId(), $comparison);
        } elseif ($projectDetail instanceof PropelObjectCollection) {
            return $this
                ->useprojectDetailQuery()
                ->filterByPrimaryKeys($projectDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByprojectDetail() only accepts arguments of type projectDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the projectDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return languageQuery The current query, for fluid interface
     */
    public function joinprojectDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('projectDetail');

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
            $this->addJoinObject($join, 'projectDetail');
        }

        return $this;
    }

    /**
     * Use the projectDetail relation projectDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\projectDetailQuery A secondary query class using the current class as primary query
     */
    public function useprojectDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinprojectDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'projectDetail', '\Orm\Model\PropelOrm\projectDetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   language $language Object to remove from the list of results
     *
     * @return languageQuery The current query, for fluid interface
     */
    public function prune($language = null)
    {
        if ($language) {
            $this->addUsingAlias(languagePeer::ID, $language->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
