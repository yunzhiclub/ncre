'use strict';

describe('Controller: ResetcardnumCtrl', function () {

  // load the controller's module
  beforeEach(module('wechatApp'));

  var ResetcardnumCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    ResetcardnumCtrl = $controller('ResetcardnumCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(ResetcardnumCtrl.awesomeThings.length).toBe(3);
  });
});
