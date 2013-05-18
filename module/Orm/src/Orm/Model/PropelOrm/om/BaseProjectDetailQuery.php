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
use Orm\Model\PropelOrm\Language;
use Orm\Model\PropelOrm\Project;
use Orm\Model\PropelOrm\ProjectDetail;
use Orm\Model\PropelOrm\ProjectDetailPeer;
use Orm\Model\PropelOrm\ProjectDetailQuery;

/**
 * Base class that represents a query for the 'project_detail' table.
 *
 *
 *
 * @method ProjectDetailQuery orderByFkProjectId($order = Criteria::ASC) Order by the fk_project_id column
 * @method ProjectDetailQuery orderByFkLangId($order = Criteria::ASC) Order by the fk_lang_id column
 * @method ProjectDetailQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method ProjectDetailQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method ProjectDetailQuery groupByFkProjectId() Group by the fk_project_id column
 * @method ProjectDetailQuery groupByFkLangId() Group by the fk_lang_id column
 * @method ProjectDetailQuery groupByLabel() Group by the label column
 * @method ProjectDetailQuery groupByDescription() Group by the description column
 *
 * @method ProjectDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ProjectDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ProjectDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ProjectDetailQuery leftJoinProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Project relation
 * @method ProjectDetailQuery rightJoinProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Project relation
 * @method ProjectDetailQuery innerJoinProject($relationAlias = null) Adds a INNER JOIN clause to the query using the Project relation
 *
 * @method ProjectDetailQuery leftJoinLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Language relation
 * @method ProjectDetailQuery rightJoinLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Language relation
 * @method ProjectDetailQuery innerJoinLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the Language relation
 *
 * @method ProjectDetail findOne(PropelPDO $con = null) Return the first ProjectDetail matching the query
 * @method ProjectDetail findOneOrCreate(PropelPDO $con = null) Return the first ProjectDetail matching the query, or a new ProjectDetail object populated from the query conditions when no match is found
 *
 * @method ProjectDetail findOneByFkProjectId(int $fk_project_id) Return the first ProjectDetail filtered by the fk_project_id column
 * @method ProjectDetail findOneByFkLangId(int $fk_lang_id) Return the first ProjectDetail filtered by the fk_lang_id column
 * @method ProjectDetail findOneByLabel(string $label) Return the first ProjectDetail filtered by the label column
 * @method ProjectDetail findOneByDescription(string $description) Return the first ProjectDetail filtered by the description column
 *
 * @method array findByFkProjectId(int $fk_project_id) Return ProjectDetail objects filtered by the fk_project_id column
 * @method array findByFkLangId(int $fk_lang_id) Return ProjectDetail objects filtered by the fk_lang_id column
 * @method array findByLabel(string $label) Return ProjectDetail objects filtered by the label column
 * @method array findByDescription(string $description) Return ProjectDetail objects filtered by the description column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseProjectDetailQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseProjectDetailQuery object.
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
            $modelName = 'Orm\\Model\\PropelOrm\\ProjectDetail';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ProjectDetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ProjectDetailQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ProjectDetailQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ProjectDetailQuery) {
            return $criteria;
        }
        $query = new ProjectDetailQuery(null, null, $modelAlias);

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
                         A Primary key composition: [$fk_project_id, $fk_lang_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ProjectDetail|ProjectDetail[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProjectDetailPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ProjectDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 ProjectDetail A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `fk_project_id`, `fk_lang_id`, `label`, `description` FROM `project_detail` WHERE `fk_project_id` = :p0 AND `fk_lang_id` = :p1';
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
            $obj = new ProjectDetail();
            $obj->hydrate($row);
            ProjectDetailPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ProjectDetail|ProjectDetail[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ProjectDetail[]|mixed the list of results, formatted by the current formatter
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
     * @return ProjectDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ProjectDetailPeer::FK_PROJECT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ProjectDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ProjectDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ProjectDetailPeer::FK_PROJECT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ProjectDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the fk_project_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProjectId(1234); // WHERE fk_project_id = 1234
     * $query->filterByFkProjectId(array(12, 34)); // WHERE fk_project_id IN (12, 34)
     * $query->filterByFkProjectId(array('min' => 12)); // WHERE fk_project_id >= 12
     * $query->filterByFkProjectId(array('max' => 12)); // WHERE fk_project_id <= 12
     * </code>
     *
     * @see       filterByProject()
     *
     * @param     mixed $fkProjectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectDetailQuery The current query, for fluid interface
     */
    public function filterByFkProjectId($fkProjectId = null, $comparison = null)
    {
        if (is_array($fkProjectId)) {
            $useMinMax = false;
            if (isset($fkProjectId['min'])) {
                $this->addUsingAlias(ProjectDetailPeer::FK_PROJECT_ID, $fkProjectId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProjectId['max'])) {
                $this->addUsingAlias(ProjectDetailPeer::FK_PROJECT_ID, $fkProjectId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectDetailPeer::FK_PROJECT_ID, $fkProjectId, $comparison);
    }

    /**
     * Filter the query on the fk_lang_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLangId(1234); // WHERE fk_lang_id = 1234
     * $query->filterByFkLangId(array(12, 34)); // WHERE fk_lang_id IN (12, 34)
     * $query->filterByFkLangId(array('min' => 12)); // WHERE fk_lang_id >= 12
     * $query->filterByFkLangId(array('max' => 12)); // WHERE fk_lang_id <= 12
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
     * @return ProjectDetailQuery The current query, for fluid interface
     */
    public function filterByFkLangId($fkLangId = null, $comparison = null)
    {
        if (is_array($fkLangId)) {
            $useMinMax = false;
            if (isset($fkLangId['min'])) {
                $this->addUsingAlias(ProjectDetailPeer::FK_LANG_ID, $fkLangId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLangId['max'])) {
                $this->addUsingAlias(ProjectDetailPeer::FK_LANG_ID, $fkLangId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectDetailPeer::FK_LANG_ID, $fkLangId, $comparison);
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
     * @return ProjectDetailQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProjectDetailPeer::LABEL, $label, $comparison);
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
     * @return ProjectDetailQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProjectDetailPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related Project object
     *
     * @param   Project|PropelObjectCollection $project The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectDetailQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProject($project, $comparison = null)
    {
        if ($project instanceof Project) {
            return $this
                ->addUsingAlias(ProjectDetailPeer::FK_PROJECT_ID, $project->getId(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectDetailPeer::FK_PROJECT_ID, $project->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProject() only accepts arguments of type Project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Project relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectDetailQuery The current query, for fluid interface
     */
    public function joinProject($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Project');

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
            $this->addJoinObject($join, 'Project');
        }

        return $this;
    }

    /**
     * Use the Project relation Project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\ProjectQuery A secondary query class using the current class as primary query
     */
    public function useProjectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Project', '\Orm\Model\PropelOrm\ProjectQuery');
    }

    /**
     * Filter the query by a related Language object
     *
     * @param   Language|PropelObjectCollection $language The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectDetailQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLanguage($language, $comparison = null)
    {
        if ($language instanceof Language) {
            return $this
                ->addUsingAlias(ProjectDetailPeer::FK_LANG_ID, $language->getId(), $comparison);
        } elseif ($language instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectDetailPeer::FK_LANG_ID, $language->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ProjectDetailQuery The current query, for fluid interface
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
        if ($relationAlias) {
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
     * @return   \Orm\Model\PropelOrm\LanguageQuery A secondary query class using the current class as primary query
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
     * @param   ProjectDetail $projectDetail Object to remove from the list of results
     *
     * @return ProjectDetailQuery The current query, for fluid interface
     */
    public function prune($projectDetail = null)
    {
        if ($projectDetail) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ProjectDetailPeer::FK_PROJECT_ID), $projectDetail->getFkProjectId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ProjectDetailPeer::FK_LANG_ID), $projectDetail->getFkLangId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
