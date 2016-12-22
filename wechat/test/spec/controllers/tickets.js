'use strict';

describe('Controller: TicketsCtrl', function () {

  // load the controller's module
  beforeEach(module('wechatApp'));

  var TicketsCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    TicketsCtrl = $controller('TicketsCtrl', {
      $scope: scope
      // place here mocked dependencies
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(TicketsCtrl.awesomeThings.length).toBe(3);
  });
});
