<?php

class drupalcs_Sniffs_ControlStructures_ControlDeclarationSignatureSniff implements PHP_CodeSniffer_Sniff {
  /**
   * Returns an array of tokens this test wants to listen for.
   *
   * @return array
   */
  public function register() {
    return array(
      T_IF,
      T_ELSE,
      T_ELSEIF,
      T_FOREACH,
      T_FOR,
      T_DO,
      T_SWITCH,
      T_WHILE,
      T_TRY,
      T_CATCH,
    );
  }

  public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
    $tokens = $phpcsFile->getTokens();

    $content = $tokens[$stackPtr]['content'];
    if ($content !== strtolower($content)) {
      $error = '%s keyword must be lowercase; expected "%s" but found "%s"';
      $data  = array(strtoupper($content), strtolower($content), $content);
      $phpcsFile->addError($error, $stackPtr, 'FoundUppercase', $data);
    }

    if ($tokens[$stackPtr + 1]['code'] !== T_WHITESPACE) {
      $error = '%s should have one space between the control keyword and opening parenthesis';
      $data  = array(strtoupper($tokens[$stackPtr]['content']));
      $phpcsFile->addError($error, $stackPtr + 1, 'Missing', $data);
    }
  }
}

?>