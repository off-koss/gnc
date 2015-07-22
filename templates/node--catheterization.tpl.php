<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <h2 class="text-center">ПРОТОКОЛ КАТЕТЕРИЗАЦИИ</h2>
  <p><div class="text-center"><?php print render($content['field_datetime']); ?></div></p>
  <p>
    Больной(ая) <?php print render($content['field_patient_reference']); ?>.
    <?php
      $patient = node_load( $node->field_patient_reference['und'][0]['target_id'] );
     ?>
    Возраст: <?php print get_age_at_date($patient->field_birthdate['und'][0]['value'], $node->field_datetime['und'][0]['value']); ?> лет.
    История болезни №<?php print $patient->field_medical_history_number['und'][0]['value']; ?>.
    Диагноз:
    <?php
      if (isset($node->field_diagnosis_ultimate[LANGUAGE_NONE]))
        print render($content['field_diagnosis_ultimate']);
      else
        print render($content['field_diagnosis_choice']);
    ?>.
  </p>
  <p>
    Показание к катетеризации &mdash; <?php print render($content['field_indications4catheteriz']); ?>.
    Катетеризация <?php print render($content['field_catheterization_type']); ?>.
  </p>
  <p>
    Показатели перед катетеризацией:
    <?php if (isset($node->field_pbc_leukocytes[LANGUAGE_NONE])): ?>
      лейкоциты <?php print render($content['field_pbc_leukocytes']); ?> x10^9/л,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_thrombocytes[LANGUAGE_NONE])): ?>
      тромбоциты <?php print render($content['field_pbc_thrombocytes']); ?> x10^9/л,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_achtv[LANGUAGE_NONE])): ?>
      АЧТВ <?php print render($content['field_pbc_achtv']); ?> сек.,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_pi[LANGUAGE_NONE])): ?>
      ПИ <?php print render($content['field_pbc_pi']); ?> %,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_f8[LANGUAGE_NONE])): ?>
      FVIII <?php print render($content['field_pbc_f8']); ?> %,
    <?php endif; ?>
    <?php if (isset($node->field_pbc_fibrinogen[LANGUAGE_NONE])): ?>
      фибриноген <?php print render($content['field_pbc_fibrinogen']); ?> г/л
    <?php endif; ?>.

    <?php if($node->field_cathz_preparation['und'][0]['value']): ?>
      Подготовка:&ensp;
      <?php if (isset($node->field_preparation_szp[LANGUAGE_NONE])): ?>
        СЗП &mdash; <?php print render($content['field_preparation_szp']) . ', '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_thrombocyte[LANGUAGE_NONE])): ?>
        тромбоциты &mdash; <?php print render($content['field_preparation_thrombocyte']) . ' доз, '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_krio[LANGUAGE_NONE])): ?>
        КРИО &mdash; <?php print render($content['field_preparation_krio']) . ', '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_protromplex[LANGUAGE_NONE])): ?>
        протромплекс &mdash; <?php print render($content['field_preparation_protromplex']) . ' ед., '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_f8[LANGUAGE_NONE])): ?>
        FVIII &mdash; <?php print render($content['field_preparation_f8']) . ' ед., '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_f7[LANGUAGE_NONE])): ?>
        FVII &mdash; <?php print render($content['field_preparation_f7']) . ' ед., '; ?>
      <?php endif; ?>
      <?php if (isset($node->field_preparation_additional[LANGUAGE_NONE])): ?>
        <?php print render($content['field_preparation_additional']); ?>
      <?php endif; ?>
      .
      Результат подготовки:
      <?php if (isset($node->field_pap_leukocytes[LANGUAGE_NONE])): ?>
        лейкоциты <?php print render($content['field_pap_leukocytes']); ?> x10^9/л,
      <?php endif; ?>
      <?php if (isset($node->field_pap_thrombocytes[LANGUAGE_NONE])): ?>
        тромбоциты <?php print render($content['field_pap_thrombocytes']); ?> x10^9/л,
      <?php endif; ?>
      <?php if (isset($node->field_pap_achtv[LANGUAGE_NONE])): ?>
        АЧТВ <?php print render($content['field_pap_achtv']); ?> сек.,
      <?php endif; ?>
      <?php if (isset($node->field_pap_pi[LANGUAGE_NONE])): ?>
        ПИ <?php print render($content['field_pap_pi']); ?> %,
      <?php endif; ?>
      <?php if (isset($node->field_pap_f8[LANGUAGE_NONE])): ?>
        FVIII <?php print render($content['field_pap_f8']); ?> %,
      <?php endif; ?>
      <?php if (isset($node->field_pap_fibrinogen[LANGUAGE_NONE])): ?>
        фибриноген <?php print render($content['field_pap_fibrinogen']); ?> г/л
      <?php endif; ?>.
    <?php else: ?>
      Без подготовки.
    <?php endif; ?>
  </p>
  <p>
    После обработки операционного поля 1% аквазаном и 1% спиртовым раствором хлоргексидина в асептических условиях

    <?php if ($node->field_anesthesia_type['und'][0]['value'] > 0): ?>
      под местной анестезией
      <?php print render($content['field_anesthesia_type']); ?>
      <?php print render($content['field_anesthesia_amount']); ?> мл
    <?php elseif ($node->field_anesthesia_type['und'][0]['value'] == 0): ?>
      под общей анестезией
    <?php elseif ($node->field_anesthesia_type['und'][0]['value'] == -1): ?>
      без анестезии
    <?php endif; ?>
    выполнена пункция и катетеризация <?php print render($content['field_cathz_vessel']); ?>.
    Всего предпринято попыток: <?php print render($content['field_cathz_number_attempts']); ?>.
    ЭКГ контроль положения катетера и высокий зубец P из правого предсердия (спайк) <?php print render($content['field_cathz_spike']); ?>.
    Результат &mdash; <?php print render($content['field_cathz_result']); ?>.
    Установлен катетер <?php print render($content['field_catheter']); ?>.
    Трудности при катетеризации &mdash;
    <?php
      if (!$node->field_cathz_difficulties['und'][0]['value'])
        print render($content['field_cathz_difficulties']);
      else
        print 'были, ' . render($content['field_cathz_difficulties_list']);
    ?>.
    Осложнения во время процедуры &mdash;
    <?php if(!isset($node->field_cathz_compl_early[LANGUAGE_NONE]) && !isset($node->field_cathz_compl_late[LANGUAGE_NONE])): ?>
      нет.
    <?php else: ?>
      <?php
        if ($node->field_cathz_compl_early[LANGUAGE_NONE][0]['value'] == 0 && $node->field_cathz_compl_late[LANGUAGE_NONE][0]['value'] == 0)
          print 'нет';
        if ($node->field_cathz_compl_early[LANGUAGE_NONE][0]['value'] != 0)
          print render($content['field_cathz_compl_early']);

        if ($node->field_cathz_compl_late[LANGUAGE_NONE][0]['value'] != 0){
          if ($node->field_cathz_compl_early[LANGUAGE_NONE][0]['value'] != 0)
            print ", ";
          print render($content['field_cathz_compl_late']);
        }
      ?>.
    <?php endif; ?>
  </p>
  <?php if (!empty($content['field_cathz_tips'])): ?>
    <p>Рекомендации: <?php print render($content['field_cathz_tips']); ?>.</p>
  <?php endif; ?>
  <br />
  <p>
    Врач-реаниматолог: <?php print render($content['field_doctor']); ?>
    ________________________
  </p>

<!--
   <?php if ($display_submitted): ?>
    <div class="posted">
      <?php if ($user_picture): ?>
        <?php print $user_picture; ?>
      <?php endif; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    print render($content);
  ?>

  <?php if (!empty($content['field_tags']) && !$is_front): ?>
    <?php print render($content['field_tags']) ?>
  <?php endif; ?>

  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>
 -->
</article>
