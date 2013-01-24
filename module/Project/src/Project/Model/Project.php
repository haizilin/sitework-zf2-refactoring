<?php
namespace Project\Model;

use Orm\Model\PropelOrm;

class Project
{
    private $_query;
    public function __construct() {
        $this->_query = new PropelOrm\ProjectQuery();

    }

    public function getTeaser($langId = 2) {
        return PropelOrm\ProjectQuery::create()
            ->filterByActive(1)
            ->useProjectDetailQuery()
            ->filterByFkLangId($langId)
            ->endUse();
    }

    public function getDetails($id = 1, $langId = 2) {
        return PropelOrm\ProjectQuery::create()
            ->useProjectDetailQuery()
            ->filterByFkLangId($langId)
            ->endUse()
            ->findPk($id);
    }
}
