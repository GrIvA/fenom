<?php

namespace Fenom;

/**
 * Unexpected token
 */
class UnexpectedTokenException extends \RuntimeException
{
    public function __construct(Tokenizer $tokens, $expect = null, $where = null)
    {
        if ($expect && count($expect) == 1 && is_string($expect[0])) {
            $expect = ", expect '" . $expect[0] . "'";
        } else {
            $expect = "";
        }
        if (!$tokens->curr) {
            $this->message = "Unexpected end of " . ($where ? : "expression") . "$expect";
        } elseif ($tokens->curr[0] === T_WHITESPACE) {
            $this->message = "Unexpected whitespace$expect";
        } elseif ($tokens->curr[0] === T_BAD_CHARACTER) {
            $this->message = "Unexpected bad characters (below ASCII 32 except \\t, \\n and \\r) in " . ($where ? : "expression") . "$expect";
        } else {
            $this->message = "Unexpected token '" . $tokens->current() . "' in " . ($where ? : "expression") . "$expect";
        }
    }
}

;