module Zxcvbn
  require "execjs"

  class Tester
    DATA_PATH = Pathname(File.expand_path('../../../data/zxcvbn.js', __FILE__))

    def initialize
      src = File.read(DATA_PATH)
      @context = ExecJS.compile(src)
    end

    def test(password, user_inputs = [])
      result = @context.eval("zxcvbn(#{password.to_json}, #{user_inputs.to_json})")
      OpenStruct.new(result)
    end
  end
end
