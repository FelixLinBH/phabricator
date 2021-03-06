<?php

final class PhabricatorDestructionEngineExtensionModule
  extends PhabricatorConfigModule {

  public function getModuleKey() {
    return 'destructionengine';
  }

  public function getModuleName() {
    return pht('Engine: Destruction');
  }

  public function renderModuleStatus(AphrontRequest $request) {
    $viewer = $request->getViewer();

    $extensions = PhabricatorDestructionEngineExtension::getAllExtensions();

    $rows = array();
    foreach ($extensions as $extension) {
      $rows[] = array(
        get_class($extension),
        $extension->getExtensionName(),
      );
    }

    $table = id(new AphrontTableView($rows))
      ->setHeaders(
        array(
          pht('Class'),
          pht('Name'),
        ))
      ->setColumnClasses(
        array(
          null,
          'wide pri',
        ));

    return id(new PHUIObjectBoxView())
      ->setHeaderText(pht('DestructionEngine Extensions'))
      ->setBackground(PHUIObjectBoxView::BLUE_PROPERTY)
      ->setTable($table);
  }

}
