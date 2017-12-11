<?php

namespace app\controllers;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $count[1] = $this->count_of_days('2016/04/18', 6, [2, 4, 6]);
        $count[2] = $this->count_of_days('2016/04/18', 6, [1, 3, 5]);
        $count[3] = $this->count_of_days('2016/04/18', 6, [1, 4]);
        $count[4] = $this->count_of_days('2016/04/19', 6, [2, 4, 6]);
        $count[5] = $this->count_of_days('2016/04/21', 1, [2, 4, 6]);

        return $this->render('index', [
            'count' => $count,
        ]);
    }

    public function count_of_days($startDate, $trainingCount, array $schedule)
    {
        $startUserDate = new \DateTime($startDate);
        $date = new \DateTime($startDate);
        $count_of_days = 0;
        while ($trainingCount > 0):
            $day_of_week = $date->format("N");
            if (in_array((int)$day_of_week, $schedule)) {
                --$trainingCount;
            }
            $date->modify('+1 day');
            if ($trainingCount == 0) {
                $count_of_days = $date->diff($startUserDate);
                return $count_of_days->days;
            }
        endwhile;

        return false;
    }
}
