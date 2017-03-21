<?php

class user extends control{

    public function create()
    {
        $data = fixer::input('post')->get();
        return $this->success($data);
    }

    public function delete()
    {
        $data = fixer::input('delete')->get();
        return $this->success($data);
    }

    public function update()
    {
        $data = fixer::input('put')->get();
        return $this->success($data);
    }

    public function getByID($id='')
    {
        return $this->success($id);
    }

    public function getByList($pid = 1,$psize = 10,$order = 'order `desc`')
    {
        $data = array(
            'id'    => $pid,
            'psize' => $psize,
            'order' => $order,
        );
        return $this->success($data);
    }

}