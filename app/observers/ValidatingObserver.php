<?php

/**
 * Watson\Validating
 *
 * Source: https://github.com/dwightwatson/validating/blob/master/src/Watson/Validating/ValidatingObserver.php
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Dwight Watson
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

class ValidatingObserver
{
    /**
     * Register the validation event for creating the model.
     *
     * @param  Model  $model
     * @return bool
     */
    public function creating($model)
    {
        return $this->performValidation($model, "creating");
    }

    /**
     * Register the validation event for updating the model.
     *
     * @param  Model  $model
     * @return bool
     */
    public function updating($model)
    {
        return $this->performValidation($model, "updating");
    }

    /**
     * Register the validation event for saving the model. Saving validation
     * should only occur if creating and updating validation does not.
     *
     * @param  Model  $model
     * @return bool
     */
    public function saving($model)
    {
        if (!$model->getRuleset("creating") && !$model->getRuleset("updating")) {
            return $this->performValidation($model, "saving");
        }
    }

    /**
     * Register the validation event for deleting the model.
     *
     * @param  Model  $model
     * @return bool
     */
    public function deleting($model)
    {
        return $this->performValidation($model, "deleting");
    }

    /**
     * Perform validation with the specified ruleset.
     *
     * @param  object  $model
     * @param  string  $event
     * @return bool
     */
    protected function performValidation($model, $event)
    {
        # If the model has validating enabled, perform it.
        if ($model->getValidating() && $model->getRuleset($event)) {
            return $model->isValid($event);
        }
    }
}
