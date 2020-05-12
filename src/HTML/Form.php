<?php
namespace App\HTML;

use DateTimeInterface;

class Form {

    private $data;

    private $errors;

    public function __construct($data, array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input (string $key, string $label, $type = 'text'): string
    {
        $value = $this->getValue($key);
        return <<<HTML
            <div class="form-group">
                <label for="field{$key}">{$label}</label>
                <input id="field{$key}" type="{$type}" name="{$key}" class="{$this->getInputCalss($key)}" value="{$value}" required>
                {$this->getErrorFeedBack($key)}
            </div>
        HTML;
    }

    public function file (string $key, string $label): string
    {
        $value = $this->getValue($key);
        return <<<HTML
            <div class="form-group">
                <label for="field{$key}">{$label}</label>
                <input id="field{$key}" type="file" name="{$key}" class="{$this->getInputCalss($key)}">
                {$this->getErrorFeedBack($key)}
            </div>
        HTML;
    }

    public function textarea (string $key, string $label): string
    {
        $value = $this->getValue($key);
        return <<<HTML
            <div class="form-group">
                <label for="field{$key}">{$label}</label>
                <textarea id="field{$key}" type="text"  name="{$key}" class="{$this->getInputCalss($key)}" rows="10" required>{$value}</textarea>
                {$this->getErrorFeedBack($key)}
            </div>
        HTML;
    }

    public function select (string $key, string $label, array $options = [])
    {
        $optionsHTML = [];
        $value = $this->getValue($key);
        foreach ($options as $k => $v) {
            $selcted = in_array($k, $value) ? " selected" : "";
            $optionsHTML[] = "<option value=\"$k\"$selcted>$v</option>";
        }
        $optionsHTML = implode('', $optionsHTML);
        return <<<HTML
            <div class="form-group">
                <label for="field{$key}">{$label}</label>
                <select id="field{$key}" name="{$key}[]" class="{$this->getInputCalss($key)}" required multiple>{$optionsHTML}</select>
                {$this->getErrorFeedBack($key)}
            </div>
        HTML;
    }

    private function getValue (string $key)
    {
        if (is_array($this->data)) {
            return $this->data[$key] ?? null;
        }
        $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ',$key)));
        $value = $this->data->$method();
        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i');
        }
        return $value;
    }

    private function getInputCalss(string $key): string
    {
        $inputClass = 'form-control';
        if (isset($this->errors[$key])) {
            $inputClass .= ' is-invalid';
        }
        return $inputClass;
    }

    private function getErrorFeedBack(string $key): string
    {
        if (isset($this->errors[$key])) {
            if (is_array($this->errors[$key])) {
                $error = implode('<br>', $this->errors[$key]);
            } else {
                $error = $this->errors[$key];
            }
            return '<div class="invalid-feedback">' . $error . '</div>';
        }
        return '';
    }
}