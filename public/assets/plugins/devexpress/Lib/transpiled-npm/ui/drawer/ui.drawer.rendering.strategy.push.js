"use strict";

exports.default = void 0;

var _uiDrawer = require("./ui.drawer.animation");

var _uiDrawerRendering = _interopRequireDefault(require("./ui.drawer.rendering.strategy"));

var _renderer = _interopRequireDefault(require("../../core/renderer"));

var _translator = require("../../animation/translator");

var _extend = require("../../core/utils/extend");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _inheritsLoose(subClass, superClass) { subClass.prototype = Object.create(superClass.prototype); subClass.prototype.constructor = subClass; _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

var PushStrategy = /*#__PURE__*/function (_DrawerStrategy) {
  _inheritsLoose(PushStrategy, _DrawerStrategy);

  function PushStrategy() {
    return _DrawerStrategy.apply(this, arguments) || this;
  }

  var _proto = PushStrategy.prototype;

  _proto._useDefaultAnimation = function _useDefaultAnimation() {
    return true;
  };

  _proto._defaultPositionRendering = function _defaultPositionRendering(config, _, animate) {
    var _this = this;

    var drawer = this.getDrawerInstance();
    (0, _renderer.default)(drawer.content()).css(drawer.isHorizontalDirection() ? 'width' : 'height', config.maxSize);

    if (drawer.getMinSize()) {
      var paddingCssPropertyName = 'padding';

      switch (drawer.calcTargetPosition()) {
        case 'left':
          paddingCssPropertyName += 'Right';
          break;

        case 'right':
          paddingCssPropertyName += 'Left';
          break;

        case 'top':
          paddingCssPropertyName += 'Bottom';
          break;

        case 'bottom':
          paddingCssPropertyName += 'Top';
          break;
      }

      (0, _renderer.default)(drawer.viewContent()).css(paddingCssPropertyName, drawer.getMinSize());
    }

    if (animate) {
      var animationConfig = {
        $element: (0, _renderer.default)(drawer.viewContent()),
        position: config.contentPosition,
        direction: drawer.calcTargetPosition(),
        duration: drawer.option('animationDuration'),
        complete: function complete() {
          _this._elementsAnimationCompleteHandler();
        }
      };

      _uiDrawer.animation.moveTo(animationConfig);
    } else {
      if (drawer.isHorizontalDirection()) {
        (0, _translator.move)((0, _renderer.default)(drawer.viewContent()), {
          left: config.contentPosition
        });
      } else {
        (0, _translator.move)((0, _renderer.default)(drawer.viewContent()), {
          top: config.contentPosition
        });
      }
    }
  };

  _proto._getPositionRenderingConfig = function _getPositionRenderingConfig(isDrawerOpened) {
    return (0, _extend.extend)(_DrawerStrategy.prototype._getPositionRenderingConfig.call(this, isDrawerOpened), {
      contentPosition: this._getPanelSize(isDrawerOpened) * this.getDrawerInstance()._getPositionCorrection(),
      maxSize: this._getPanelSize(true)
    });
  };

  _proto.onPanelContentRendered = function onPanelContentRendered() {
    (0, _renderer.default)(this.getDrawerInstance().viewContent()).addClass('dx-theme-background-color');
  };

  return PushStrategy;
}(_uiDrawerRendering.default);

var _default = PushStrategy;
exports.default = _default;
module.exports = exports.default;