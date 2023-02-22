gap-tutor
========

This repository contains is a prototype for extending the STACK plugin for 
Moodle with the new question type for Moodle quiz, to be able to connect 
to the GAP SCSCP server (or any other SCSCP-compliant computer algebra system)
using the SCSCP protocol (http://www.symbolic-computing.org/scscp).

The main file is `gapserver.g` which is the configuration file for the GAP 
SCSCP server. The php code is experimental and is now being continued further 
in https://github.com/olexandr-konovalov/moodle-qtype_stack and eventually will 
hopefully result in a pull request to https://github.com/maths/moodle-qtype_stack.

Setting up and testing the development environment (on OS X):

- Install Moodle from https://download.moodle.org/

- Install Stack as described in its 
  [installation instructions](https://github.com/maths/moodle-qtype_stack/blob/master/doc/en/Installation/index.md),
  with the only difference is that you should get the code using git by running 
  the following command in the top level folder of your Moodle installation
  (e.g. in `/Applications/MAMP/htdocs/moodle32/`): 
  ```
  git clone https://github.com/olexandr-konovalov/moodle-qtype_stack question/type/stack.
  ```

- start GAP SCSCP server with `gap gapserver.g`

- start MAMP, open its WebStart page in your browser, go to the moodle page,
  and login as the "Admin" user.
  
- Navigate to ADMINISTRATION -> Site administration -> Plugins -> Question types -> STACK

- In the list of links, click "The answer-tests script" and choose the answer test "Gap".
  This will perform unit tests from [`tests/fixtures/answertestfixtures.class.php`](https://github.com/olexandr-konovalov/moodle-qtype_stack/blob/master/tests/fixtures/answertestfixtures.class.php).
  New unit tests should be added to that file.
  
The code for the prototype GAP answer test in STACK is located in
[`stack/answertest/gap.class.php`](https://github.com/olexandr-konovalov/moodle-qtype_stack/blob/master/stack/answertest/gap.class.php).

