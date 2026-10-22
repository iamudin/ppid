<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3FormValidation
{
    protected array $rules = [];
    protected array $errors = [];
    protected string $prefix = '<p>';
    protected string $suffix = '</p>';

    public function set_rules($field, string $label = '', $rules = '', array $errors = []): self
    {
        if (is_array($field)) {
            foreach ($field as $row) {
                $this->set_rules($row['field'], $row['label'] ?? '', $row['rules'] ?? '', $row['errors'] ?? []);
            }
            return $this;
        }

        $this->rules[$field] = [
            'field'  => $field,
            'label'  => $label ?: $field,
            'rules'  => $rules,
            'errors' => $errors,
        ];
        return $this;
    }

    public function set_error_delimiters(string $prefix = '<p>', string $suffix = '</p>'): self
    {
        $this->prefix = $prefix;
        $this->suffix = $suffix;
        return $this;
    }

    public function set_message(string $rule, string $val): self
    {
        return $this;
    }

    public function run(?string $group = ''): bool
    {
        $this->errors = [];
        $request = service('request');
        $post = $request->getPost();

        foreach ($this->rules as $field => $data) {
            $val = $post[$field] ?? null;
            $ruleString = is_array($data['rules']) ? implode('|', $data['rules']) : (string) $data['rules'];
            $rulesList = explode('|', $ruleString);

            foreach ($rulesList as $r) {
                $r = trim($r);
                if ($r === '' || $r === 'trim') {
                    continue;
                }
                if ($r === 'required' && ($val === null || trim((string) $val) === '')) {
                    $this->errors[$field] = $this->prefix . 'The ' . $data['label'] . ' field is required.' . $this->suffix;
                    break;
                }
                if ($r === 'valid_email' && $val && !filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = $this->prefix . 'The ' . $data['label'] . ' field must contain a valid email address.' . $this->suffix;
                    break;
                }
            }
        }

        return empty($this->errors);
    }

    public function error(string $field, string $prefix = '', string $suffix = ''): string
    {
        if (empty($this->errors[$field])) {
            return '';
        }
        $err = $this->errors[$field];
        if ($prefix !== '' || $suffix !== '') {
            return $prefix . strip_tags($err) . $suffix;
        }
        return $err;
    }

    public function error_string(string $prefix = '', string $suffix = ''): string
    {
        if (empty($this->errors)) {
            return '';
        }
        if ($prefix !== '' || $suffix !== '') {
            $out = '';
            foreach ($this->errors as $err) {
                $out .= $prefix . strip_tags($err) . $suffix;
            }
            return $out;
        }
        return implode('', $this->errors);
    }

    public function reset(): void
    {
        $this->rules = [];
        $this->errors = [];
    }
}
