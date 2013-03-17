<?php

namespace Orm\Model\PropelOrm;

use Orm\Model\PropelOrm\om\BaseCategory;
use Orm\Model\PropelOrm\om\BaseCategoryQuery;
use Orm\Model\PropelOrm\om\BaseCategoryDetailQuery;
use Orm\Model\PropelOrm\om\BaseServiceQuery;
use Orm\Model\PropelOrm\om\BaseService;


/**
 * Skeleton subclass for representing a row from the 'category' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.PropelOrm
 */
class Category extends BaseCategory
{
    const SERVICES_ID     = 1;
    const TECHNOLOGIES_ID = 2;

    public static function getCategory($categoryId = 1, $langId = 2) {
        $baseServiceQuery = BaseServiceQuery::create()
            ->filterByFkCategoryId($categoryId)
            ->joinServiceDetail()
            ->useServiceDetailQuery()
            ->filterByFkLangId($langId)
            ->endUse();

        return $baseServiceQuery;
    }

    public static function getCategoryTechnologies($langId = 2) {

    }
}
