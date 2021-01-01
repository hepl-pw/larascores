<?php

it('is an admin', function () {
    $this->assertTrue(\App\Models\User::find(1)->isAdmin);
});
