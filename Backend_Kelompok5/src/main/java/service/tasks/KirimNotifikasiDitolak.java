package service.tasks;

import org.camunda.bpm.engine.delegate.DelegateExecution;
import org.camunda.bpm.engine.delegate.JavaDelegate;

public class KirimNotifikasiDitolak implements JavaDelegate {
    @Override
    public void execute(DelegateExecution delegateExecution) throws Exception{
        System.out.println("Notofikasi ditolak : "+delegateExecution.getVariable("nama"));
    }
}